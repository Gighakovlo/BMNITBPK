<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data === null) {
    echo json_encode(['status' => 'gagal', 'message' => 'Data JSON yang dikirim tidak valid.']);
    exit;
}

$id = $data['id'];
$nup = $data['nup'];
$namaBarang = $data['namaBarang'];
$merk = $data['merk'];
$kondisi = $data['kondisi'];
$umurAset = !empty($data['umurAset']) ? (int)$data['umurAset'] : NULL;
$tglBuku = !empty($data['tglBuku']) ? $data['tglBuku'] : NULL;
$tglPerolehan = !empty($data['tglPerolehan']) ? $data['tglPerolehan'] : NULL;
$nilaiAset = !empty($data['nilaiAset']) ? (int)$data['nilaiAset'] : NULL;
$lokasi = $data['lokasi'];
$fotoLink = $data['fotoLink'];

// ===== PERBAIKAN NAMA KOLOM DI DALAM QUERY INI =====
$sql = "UPDATE db_bmnit_bpkyk SET 
            nup = ?, 
            nama_barang = ?, 
            merk = ?, 
            kondisi = ?, 
            umur_aset = ?, 
            tanggal_buku_pertama = ?, 
            tanggal_perolehan = ?, 
            nilai_perolehan = ?, 
            lokasi = ?, 
            foto_link = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssssisssssi",
    $nup, $namaBarang, $merk, $kondisi, $umurAset,
    $tglBuku, $tglPerolehan, $nilaiAset, $lokasi, $fotoLink,
    $id
);

if ($stmt->execute()) {
    echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil diperbarui.']);
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'Error saat eksekusi: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>