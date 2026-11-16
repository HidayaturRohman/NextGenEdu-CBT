<?php

class Database {

    public $lastError = '';

    private function setProgress($percent, $message, $status = 'running') {
        $progressFile = dirname(__DIR__) . '/writable/install_progress.json';
        @file_put_contents($progressFile, json_encode([
            'percent' => $percent,
            'message' => $message,
            'status'  => $status
        ]));
    }

    function create_database($data) {
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->lastError = '';
        $this->setProgress(35, 'Menghubungkan ke MySQL server...');

        // 1. Coba koneksi langsung ke target database (standar cPanel / aaPanel di mana database sudah dibuat)
        try {
            $mysqli = @new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
            if (!$mysqli->connect_errno) {
                $mysqli->close();
                $this->setProgress(50, 'Database `' . htmlspecialchars($data['database']) . '` terhubung.');
                return true;
            }
        } catch (\Throwable $e) {}

        // 2. Jika koneksi langsung belum berhasil, coba koneksi ke MySQL server untuk membuat database
        try {
            $mysqli = @new mysqli($data['hostname'], $data['username'], $data['password'], '');
            if ($mysqli->connect_errno) {
                $this->lastError = "Koneksi ke MySQL gagal: " . $mysqli->connect_error . " (Error #" . $mysqli->connect_errno . ")";
                error_log($this->lastError);
                return false;
            }

            $this->setProgress(45, 'Membuat database `' . htmlspecialchars($data['database']) . '`...');
            $database = $mysqli->real_escape_string($data['database']);
            if (!$mysqli->query("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
                $this->lastError = "Gagal membuat database: " . $mysqli->error;
                error_log($this->lastError);
                $mysqli->close();
                return false;
            }

            $mysqli->close();
            return true;
        } catch (\Throwable $e) {
            $this->lastError = "Gagal koneksi MySQL: " . $e->getMessage();
            return false;
        }
    }

    function create_tables($data) {
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->lastError = '';
        $this->setProgress(60, 'Menghubungkan ke database `' . htmlspecialchars($data['database']) . '`...');

        try {
            $mysqli = @new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
            if ($mysqli->connect_errno) {
                $this->lastError = "Koneksi ke database gagal: " . $mysqli->connect_error;
                error_log($this->lastError);
                return false;
            }

            $query = $mysqli->query("SHOW TABLES LIKE 'users'");
            if ($query === false) {
                $this->lastError = "Error executing query: " . $mysqli->error;
                $mysqli->close();
                return false;
            }

            if ($query->num_rows <= 0) {
                $this->setProgress(75, 'Membaca skema master.sql...');
                $sqlFile = '../public/assets/app/db/master.sql';
                if (!file_exists($sqlFile)) {
                    $sqlFile = dirname(__DIR__) . '/public/assets/app/db/master.sql';
                }
                if (!file_exists($sqlFile)) {
                    $sqlFile = __DIR__ . '/master.sql';
                }
                $sql = @file_get_contents($sqlFile);
                if ($sql === false) {
                    $this->lastError = "Gagal membuka file master.sql";
                    $mysqli->close();
                    return false;
                }

                // Remove UTF-8 BOM if present
                if (substr($sql, 0, 3) === "\xEF\xBB\xBF") {
                    $sql = substr($sql, 3);
                }
                // Auto convert UTF-16 LE/BE if present
                if (substr($sql, 0, 2) === "\xFF\xFE" || substr($sql, 0, 2) === "\xFE\xFF") {
                    if (function_exists('mb_convert_encoding')) {
                        $sql = mb_convert_encoding($sql, 'UTF-8', 'UTF-16');
                    }
                }

                // Normalisasi collation agar kompatibel dengan MySQL 5.7 / MariaDB 10.x / MySQL 8.x
                $sql = str_replace('utf8mb4_0900_ai_ci', 'utf8mb4_unicode_ci', $sql);
                $sql = str_replace('utf8mb4_0900_bin', 'utf8mb4_bin', $sql);

                $this->setProgress(80, 'Menyiapkan import skema database...');
                $mysqli->set_charset('utf8mb4');
                $mysqli->query("SET FOREIGN_KEY_CHECKS = 0");
                $mysqli->query("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO'");

                // Pisahkan statement berdasarkan titik koma di akhir baris
                $queries = preg_split('/;\s*[\r\n]+/', $sql);
                $total = count($queries);

                foreach ($queries as $idx => $query) {
                    $query = trim($query);
                    if (empty($query)) {
                        continue;
                    }
                    // Strip leading and embedded comment lines
                    $cleanLines = [];
                    foreach (explode("\n", $query) as $line) {
                        $trimL = trim($line);
                        if (strpos($trimL, '--') === 0 || strpos($trimL, '#') === 0) {
                            continue;
                        }
                        $cleanLines[] = $line;
                    }
                    $query = trim(implode("\n", $cleanLines));
                    if (empty($query)) {
                        continue;
                    }
                    if (!$mysqli->query($query)) {
                        $err = $mysqli->error;
                        // Jika hanya peringatan table already exists, abaikan
                        if (strpos(strtolower($err), 'already exists') === false) {
                            $this->lastError = "Gagal pada query #$idx: " . $err;
                            $this->setProgress(0, $this->lastError, 'error');
                            $mysqli->close();
                            return false;
                        }
                    }
                    if ($total > 0 && $idx % 5 === 0) {
                        $pct = min(96, 80 + (int)(($idx / $total) * 16));
                        $this->setProgress($pct, "Mengimpor tabel ($idx / $total)...");
                    }
                }

                $mysqli->query("SET FOREIGN_KEY_CHECKS = 1");
            }

            $this->setProgress(98, 'Verifikasi struktur tabel selesai...');
            $mysqli->close();
            return true;
        } catch (\Throwable $e) {
            $this->lastError = "Exception saat membuat tabel: " . $e->getMessage();
            return false;
        }
    }
}
