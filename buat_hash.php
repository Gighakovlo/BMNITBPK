<?php
// Panggil file koneksi kita
require_once 'includes/db_connection.php';

// --- KONFIGURASI ---
// Ganti email dan password di bawah ini sesuai dengan user yang ingin Anda buat hash-nya
$email_to_update = 'superadmin@bpk.go.id';
$plain_password = 'INIPASSWORDSUPERADMIN'; // Ini password asli yang ingin Anda set

echo "Memulai proses hashing untuk: " . htmlspecialchars($email_to_update) . "<br>";

// --- PROSES HASHING ---
// Menggunakan fungsi password_hash() bawaan PHP yang sangat aman
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

echo "Password asli: " . htmlspecialchars($plain_password) . "<br>";
echo "Hasil hash: " . htmlspecialchars($hashed_password) . "<br><br>";

// --- PROSES UPDATE DATABASE ---
$sql = "UPDATE users SET password_hash = ? WHERE email = ?";
$stmt = $conn->prepare($sql);

// Periksa jika statement berhasil di-prepare
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("ss", $hashed_password, $email_to_update);

if ($stmt->execute()) {
    echo "<strong>SUKSES:</strong> Password telah berhasil di-hash dan diperbarui di database.";
} else {
    echo "<strong>GAGAL:</strong> Error saat memperbarui password: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>