<?php
// Installer handler - CI4 Native
mysqli_report(MYSQLI_REPORT_OFF);
error_reporting(0);
ini_set('display_errors', '0');

require_once('taskCoreClass.php');
require_once('databaseLibrary.php');

$core     = new Core();
$database = new Database();

$progressFile = dirname(__DIR__) . '/writable/install_progress.json';

function updateProgress($percent, $message, $status = 'running') {
    global $progressFile;
    @file_put_contents($progressFile, json_encode([
        'percent' => $percent,
        'message' => $message,
        'status'  => $status
    ]));
}

// Progress check action (AJAX GET)
if (isset($_GET['action']) && $_GET['action'] === 'progress') {
    header('Content-Type: application/json; charset=utf-8');
    if (file_exists($progressFile)) {
        echo file_get_contents($progressFile);
    } else {
        echo json_encode(['percent' => 0, 'message' => 'Memulai proses...', 'status' => 'pending']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');

    try {
        $postData = $_POST;
        $cond     = (int)($postData['cond'] ?? 0);

        // Jika user telah mengisi konfigurasi form, langsung jalankan instalasi
        if ($cond === 0 && !empty($postData['hostname']) && !empty($postData['username']) && !empty($postData['database'])) {
            $cond = 1;
        }

        $is_first    = $cond === 0;
        $db_exist    = $cond === 2;
        $table_exist = $cond === 3;

        if ($is_first) {
            updateProgress(15, 'Memeriksa konfigurasi database...');
            $db_is_exist = $core->dbExist();
            if ($db_is_exist['status']) {
                $table_is_exist = $core->tableExist();
                if ($table_is_exist['status']) {
                    updateProgress(100, 'Tabel sudah ada.', 'success');
                    $message = $core->show_message(3, 'info', "Tabel sudah ada, melanjutkan instalasi.", $table_is_exist['data']);
                } else {
                    updateProgress(100, 'Database ditemukan.', 'success');
                    $message = $core->show_message(2, 'info', "Anda akan menggunakan database yang sudah ada, pastikan database sudah sesuai.", $db_is_exist['data']);
                }
            } else {
                updateProgress(0, 'Silakan isi parameter form.', 'pending');
                $message = $core->show_message(1, 'info', 'Silakan isi semua parameter konfigurasi database Anda.');
            }
        } else {
            updateProgress(20, 'Memeriksa parameter input...');

            // Cek input wajib
            if (!$db_exist && !$table_exist && !$core->checkEmpty($postData)) {
                updateProgress(0, 'Gagal: Parameter tidak lengkap', 'error');
                $message = $core->show_message(4, 'error', "Semua parameter database wajib diisi.");
            }
            // Buat / Hubungkan ke database
            elseif (!$db_exist && !$table_exist && !$database->create_database($postData)) {
                $err = !empty($database->lastError) ? $database->lastError : "Gagal menghubungkan ke database MySQL. Pastikan host, username, password, dan nama database benar.";
                updateProgress(0, $err, 'error');
                $message = $core->show_message(6, 'error', $err);
            }
            // Tulis konfigurasi ke .env (CI4) setelah database terhubung
            elseif (!$db_exist && !$table_exist && !$core->write_db_config($postData)) {
                updateProgress(0, 'Gagal menulis file .env', 'error');
                $message = $core->show_message(5, 'error', "Tidak bisa menulis konfigurasi ke file .env. Pastikan permission folder dan .env dapat ditulis.");
            }
            // Buat tabel dari master.sql
            elseif (!$table_exist && !$database->create_tables($postData)) {
                $err = !empty($database->lastError) ? $database->lastError : "Gagal mengimpor tabel database.";
                updateProgress(0, $err, 'error');
                $message = $core->show_message(8, 'error', $err);
            }
            // Sukses
            else {
                @file_put_contents(dirname(__DIR__) . '/writable/installed.txt', date('Y-m-d H:i:s'));
                updateProgress(100, 'Database dan tabel berhasil dibuat! ✓', 'success');
                $message = $core->show_message(9, 'success', 'Database dan tabel berhasil disiapkan. Aplikasi siap digunakan!');
            }
        }
    } catch (\Throwable $e) {
        updateProgress(0, 'Error sistem: ' . $e->getMessage(), 'error');
        $message = $core->show_message(8, 'error', 'Error sistem: ' . $e->getMessage());
    }

    echo $message;
    exit;
}