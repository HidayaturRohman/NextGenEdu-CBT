<?php
/**
 * Installer Core Class - CI4 Native
 * Migrated from CI3: reads/writes .env instead of application/config/database.php
 */

class Core
{
    /**
     * Path ke .env CI4 (satu level di atas installer/)
     */
    private function envPath(): string
    {
        return dirname(__DIR__) . '/.env';
    }

    /**
     * Baca konfigurasi DB dari .env CI4
     */
    private function readEnvDb(): array
    {
        $envPath = $this->envPath();
        if (!file_exists($envPath)) {
            return [];
        }

        $config = [];
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (preg_match('/^database\.default\.(\w+)\s*=\s*(.*)$/', trim($line), $m)) {
                $config[$m[1]] = trim($m[2]);
            }
        }

        return [
            'hostname' => $config['hostname'] ?? '',
            'username' => $config['username'] ?? '',
            'password' => $config['password'] ?? '',
            'database' => $config['database'] ?? '',
        ];
    }

    /**
     * Cek apakah file .env dapat ditulis (pengganti checkFile)
     */
    public function checkFile(): bool
    {
        $envPath = $this->envPath();
        // .env harus ada dan writable, atau direktorinya writable untuk dibuat
        return (file_exists($envPath) && is_writable($envPath))
            || (!file_exists($envPath) && is_writable(dirname($envPath)));
    }

    /**
     * Validasi input tidak kosong
     */
    public function checkEmpty(array $data): bool
    {
        return !empty($data['hostname'])
            && !empty($data['username'])
            && !empty($data['database']);
    }

    /**
     * Buat response JSON standar
     */
    public function show_message(int $condition, string $type, string $message, $data = null): string
    {
        return json_encode([
            'cond'    => $condition,
            'type'    => $type,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Cek apakah database sudah dikonfigurasi & bisa diakses (baca dari .env)
     */
    public function dbExist(): array
    {
        $ret = ['status' => false];
        $data = $this->readEnvDb();

        if (empty($data['hostname']) || empty($data['database'])) {
            return $ret;
        }

        try {
            $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], '');
            if ($mysqli->connect_error) {
                return $ret;
            }

            $dbname = $mysqli->real_escape_string($data['database']);
            $result = $mysqli->query("SHOW DATABASES LIKE '$dbname'");
            $exists = $result && $result->num_rows > 0;

            $ret['status'] = $exists;
            $ret['data']   = $data;
            $mysqli->close();
        } catch (\Exception $e) {
            $ret['status'] = false;
            $ret['data']   = 'Gagal koneksi DB: ' . $e->getMessage();
        }

        return $ret;
    }

    /**
     * Cek apakah tabel sudah ada di database (baca dari .env)
     */
    public function tableExist(): array
    {
        $ret = ['status' => false];
        $data = $this->readEnvDb();

        if (empty($data['hostname']) || empty($data['database'])) {
            return $ret;
        }

        try {
            $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], '');
            if ($mysqli->connect_error) {
                return $ret;
            }

            $dbname = $mysqli->real_escape_string($data['database']);
            $mysqli->select_db($dbname);

            $result = $mysqli->query("SHOW TABLES");
            $count  = $result ? $result->num_rows : 0;

            $ret['status'] = $count > 0;
            $ret['data']   = $data;
            $mysqli->close();
        } catch (\Exception $e) {
            $ret['status'] = false;
            $ret['data']   = 'Gagal koneksi DB: ' . $e->getMessage();
        }

        return $ret;
    }

    /**
     * Tulis konfigurasi DB ke .env CI4 (menggantikan write ke application/config/database.php)
     */
    public function write_db_config(array $data): bool
    {
        $envPath = $this->envPath();

        $hostname = htmlspecialchars($data['hostname'], ENT_QUOTES);
        $username = htmlspecialchars($data['username'], ENT_QUOTES);
        $password = htmlspecialchars($data['password'] ?? '', ENT_QUOTES);
        $database = htmlspecialchars($data['database'], ENT_QUOTES);

        // Baca .env yang ada atau buat baru
        $content = file_exists($envPath) ? file_get_contents($envPath) : '';

        $keys = [
            'database.default.hostname' => $hostname,
            'database.default.database' => $database,
            'database.default.username' => $username,
            'database.default.password' => $password,
            'database.default.DBDriver' => 'MySQLi',
            'database.default.charset'  => 'utf8',
        ];

        foreach ($keys as $key => $val) {
            $line = "{$key} = {$val}";
            if (preg_match("/^" . preg_quote($key, '/') . "\s*=/m", $content)) {
                // Update existing
                $content = preg_replace("/^" . preg_quote($key, '/') . "\s*=.*/m", $line, $content);
            } else {
                // Add new
                $content .= "\n{$line}";
            }
        }

        try {
            if (file_put_contents($envPath, $content) === false) {
                error_log("Gagal menulis .env");
                return false;
            }
            return true;
        } catch (\Exception $e) {
            error_log("write_db_config error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Helper: ambil semua data (tidak diubah)
     */
    public function getAllData(array $data): array
    {
        return $data;
    }
}
