<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

// Siapkan query INSERT, kolom 'id' tidak perlu dimasukkan
$sql_insert = "INSERT INTO db_bmnit_bpkyk (nup, nama_barang, merk, kondisi, umur_aset, tanggal_buku_pertama, tanggal_perolehan, nilai_perolehan, lokasi, foto_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql_insert);

$tgl_buku = !empty($_POST['tglBuku']) ? $_POST['tglBuku'] : NULL;
$tgl_perolehan = !empty($_POST['tglPerolehan']) ? $_POST['tglPerolehan'] : NULL;

// 's' = string, 'i' = integer
$stmt->bind_param(
    "ssssisssss",
    $_POST['nup'],
    $_POST['namaBarang'],
    $_POST['merk'],
    $_POST['kondisi'],
    $_POST['umurAset'],
    $tgl_buku,
    $tgl_perolehan,
    $_POST['nilaiAset'],
    $_POST['lokasi'],
    $_POST['fotoLink']
);

if ($stmt->execute()) {
    // Ambil ID yang baru saja dibuat oleh database
    $newId = $conn->insert_id;
    echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil ditambahkan', 'newId' => $newId]);
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>