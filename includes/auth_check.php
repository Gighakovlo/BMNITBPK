<?php
session_start();
require_once 'db_connection.php';

// Jika pengguna tidak login, tendang ke halaman login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data lengkap pengguna dari database dan simpan di session
// agar bisa diakses di semua halaman
if (!isset($_SESSION['user_data'])) {
    $email = $_SESSION['user_email'];
    
    // Siapkan query untuk mengambil data user
    $sql = "SELECT id, email, role, nama_lengkap, id_foto_profil FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['user_data'] = $result->fetch_assoc();
    } else {
        // Jika karena suatu hal data user tidak ada, logout paksa
        session_destroy();
        header("Location: login.php");
        exit;
    }
    $stmt->close();
}
?>