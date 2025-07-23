<?php
// Memulai session untuk menyimpan status login
session_start();

// Memanggil file koneksi database
require_once '../includes/db_connection.php';

// Mengatur header agar respons berupa JSON
header('Content-Type: application/json');

// Mengambil data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// --- Logika Super Admin (Hard-coded) ---
$super_admin_email = "superadmin@bpk.go.id";
$super_admin_password = "PasswordSuperAdminRahasia123"; // Ganti dengan password kuat Anda

if ($email === $super_admin_email && $password === $super_admin_password) {
    $_SESSION['is_logged_in'] = true;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_role'] = 'superadmin';
    echo json_encode(['status' => 'sukses', 'role' => 'superadmin']);
    exit();
}

// --- Logika Admin Biasa (dari Database) ---
// Menggunakan prepared statement untuk keamanan
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Memverifikasi password yang sudah di-hash
    if (password_verify($password, $user['password_hash'])) {
        // Jika password cocok
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        echo json_encode(['status' => 'sukses', 'role' => $user['role']]);
    } else {
        // Jika password salah
        echo json_encode(['status' => 'gagal', 'message' => 'Email atau password salah.']);
    }
} else {
    // Jika email tidak ditemukan
    echo json_encode(['status' => 'gagal', 'message' => 'Email atau password salah.']);
}

$stmt->close();
$conn->close();
?>