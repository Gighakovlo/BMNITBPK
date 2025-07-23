<?php
// Konfigurasi Database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bmnit_bpkyk'; // Pastikan nama DB ini benar

// Membuat koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    // Hentikan eksekusi dan kirim error jika koneksi gagal
    // Ini lebih baik daripada membiarkan script lain berjalan
    http_response_code(500);
    echo json_encode(['status' => 'gagal', 'message' => 'Koneksi ke database gagal: ' . $conn->connect_error]);
    exit;
}

// Mengatur set karakter
$conn->set_charset("utf8mb4");

// Tag penutup PHP sengaja dihilangkan untuk mencegah output yang tidak diinginkan