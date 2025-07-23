<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data === null) {
    echo json_encode(['status' => 'gagal', 'message' => 'Data JSON tidak valid.']);
    exit;
}

// Cek apakah ini permintaan hapus massal (bulk delete)
if (isset($data['ids']) && is_array($data['ids']) && !empty($data['ids'])) {
    $ids_to_delete = $data['ids'];
    // Membuat placeholder '?' sebanyak jumlah ID
    $placeholders = implode(',', array_fill(0, count($ids_to_delete), '?'));
    // Menentukan tipe data binding ('i' untuk setiap integer)
    $types = str_repeat('i', count($ids_to_delete));

    $sql = "DELETE FROM db_bmnit_bpkyk WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    // Bind semua ID ke statement
    $stmt->bind_param($types, ...$ids_to_delete);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sukses', 'message' => count($ids_to_delete) . ' data berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $stmt->error]);
    }

} 
// Jika bukan, cek apakah ini permintaan hapus tunggal
else if (isset($data['id'])) {
    $id_to_delete = $data['id'];

    $sql = "DELETE FROM db_bmnit_bpkyk WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_to_delete);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sukses', 'message' => 'Data berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Error: ' . $stmt->error]);
    }
} else {
    echo json_encode(['status' => 'gagal', 'message' => 'Tidak ada ID yang diberikan untuk dihapus.']);
}

$stmt->close();
$conn->close();
?>