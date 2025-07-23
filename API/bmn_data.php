<?php
require_once '../includes/db_connection.php';
header('Content-Type: application/json');

// Cek apakah ada parameter 'id' yang dikirim melalui URL
if (isset($_GET['id'])) {
    // --- AMBIL DETAIL SATU BARANG ---
    $id_barang = $_GET['id'];
    
    $sql = "SELECT * FROM db_bmnit_bpkyk WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
    $stmt->close();

} else {
    // --- AMBIL SEMUA DATA BARANG (Untuk tabel utama) ---
    $sql = "SELECT id, nama_barang, merk, kondisi, lokasi FROM db_bmnit_bpkyk";
    $result = $conn->query($sql);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

$conn->close();
?>