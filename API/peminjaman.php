<?php
// Selalu mulai session di baris paling atas
session_start(); 

require_once '../includes/db_connection.php';
header('Content-Type: application/json');

// Baca data JSON dari body request jika ada
$input = json_decode(file_get_contents('php://input'), true);

// Tentukan aksi dari parameter GET atau dari data POST
$action = $_GET['action'] ?? $input['action'] ?? '';

// --- RUTE DEBUGGING KHUSUS ---
// Aksi ini bisa kita panggil kapan saja untuk mengecek status session
if ($action === 'debug_session') {
    $response = [
        'status' => 'debug_info',
        'session_status' => session_status(), // 2 jika aktif
        'session_data' => $_SESSION
    ];
    echo json_encode($response);
    exit; // Hentikan script setelah mengirim info debug
}

// --- RUTE UNTUK MENGAMBIL SEMUA TRANSAKSI PEMINJAMAN ---
if ($action === 'getAll') {
    $sql = "SELECT p.id, p.nama_peminjam, p.tgl_pinjam, p.tgl_rencana_kembali, p.status, b.nama_barang 
            FROM peminjaman p
            JOIN db_bmnit_bpkyk b ON p.bmn_item_id = b.id
            ORDER BY p.id DESC";
    $result = $conn->query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $data[] = $row; }
    }
    echo json_encode(['status' => 'sukses', 'data' => $data]);
} 

// --- RUTE UNTUK MENGAMBIL BARANG YANG TERSEDIA ---
else if ($action === 'getAvailableItems') {
    $sql = "SELECT id, nama_barang, merk FROM db_bmnit_bpkyk WHERE status_peminjaman = 'Tersedia'";
    $result = $conn->query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $data[] = $row; }
    }
    echo json_encode(['status' => 'sukses', 'data' => $data]);
}

// --- RUTE UNTUK MEMBUAT TRANSAKSI PEMINJAMAN BARU ---
else if ($action === 'create') {
    // Periksa session SEBELUM melakukan apapun
    if (!isset($_SESSION['is_logged_in']) || !isset($_SESSION['user_email'])) {
        echo json_encode(['status' => 'gagal', 'message' => 'Sesi tidak valid atau Anda belum login.']);
        exit;
    }
    $admin_email = $_SESSION['user_email'];

    $sql_insert = "INSERT INTO peminjaman (bmn_item_id, nama_peminjam, jabatan_peminjam, unit_kerja_peminjam, tgl_pinjam, tgl_rencana_kembali, admin_email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issssss", 
        $input['bmn_item_id'], 
        $input['nama_peminjam'],
        $input['jabatan_peminjam'],
        $input['unit_kerja_peminjam'],
        $input['tgl_pinjam'],
        $input['tgl_rencana_kembali'],
        $admin_email
    );
    
    if ($stmt_insert->execute()) {
        $sql_update = "UPDATE db_bmnit_bpkyk SET status_peminjaman = 'Dipinjam' WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $input['bmn_item_id']);
        $stmt_update->execute();
        echo json_encode(['status' => 'sukses', 'message' => 'Data peminjaman berhasil disimpan.']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Gagal menyimpan data: ' . $stmt_insert->error]);
    }
}
// --- RUTE BARU: UNTUK MENANDAI BARANG TELAH KEMBALI ---
else if ($action === 'markAsReturned') {
    $peminjaman_id = $input['peminjaman_id'];

    // 1. Ambil ID barang dari transaksi peminjaman
    $sql_get_item_id = "SELECT bmn_item_id FROM peminjaman WHERE id = ?";
    $stmt_get = $conn->prepare($sql_get_item_id);
    $stmt_get->bind_param("i", $peminjaman_id);
    $stmt_get->execute();
    $result = $stmt_get->get_result();
    $item = $result->fetch_assoc();
    $bmn_item_id = $item['bmn_item_id'];

    if ($bmn_item_id) {
        // 2. Update status transaksi di tabel peminjaman
        $tgl_sekarang = date("Y-m-d");
        $sql_update_peminjaman = "UPDATE peminjaman SET status = 'Dikembalikan', tgl_aktual_kembali = ? WHERE id = ?";
        $stmt_update_peminjaman = $conn->prepare($sql_update_peminjaman);
        $stmt_update_peminjaman->bind_param("si", $tgl_sekarang, $peminjaman_id);
        $stmt_update_peminjaman->execute();

        // 3. Update status barang di tabel BMN menjadi 'Tersedia'
        $sql_update_bmn = "UPDATE db_bmnit_bpkyk SET status_peminjaman = 'Tersedia' WHERE id = ?";
        $stmt_update_bmn = $conn->prepare($sql_update_bmn);
        $stmt_update_bmn->bind_param("i", $bmn_item_id);
        $stmt_update_bmn->execute();

        echo json_encode(['status' => 'sukses', 'message' => 'Barang telah ditandai sebagai dikembalikan.']);
    } else {
        echo json_encode(['status' => 'gagal', 'message' => 'Transaksi peminjaman tidak ditemukan.']);
    }
}

else {
    echo json_encode(['status' => 'gagal', 'message' => 'Aksi tidak valid.']);
}

$conn->close();
?>

