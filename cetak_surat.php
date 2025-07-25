<?php
// Memulai session dan memeriksa status login
require_once 'includes/auth_check.php';
// Memanggil koneksi database
require_once 'includes/db_connection.php';

// Ambil ID peminjaman dari URL
$peminjaman_id = $_GET['id'] ?? null;

if (!$peminjaman_id) {
    die("Error: ID Peminjaman tidak ditemukan.");
}

// Query untuk mengambil data lengkap dari transaksi peminjaman
$sql = "SELECT 
            p.*, 
            b.nama_barang, b.merk, b.nup,
            u.nama_lengkap as nama_admin, u.nip as nip_admin
        FROM 
            peminjaman p
        JOIN 
            db_bmnit_bpkyk b ON p.bmn_item_id = b.id
        LEFT JOIN
            users u ON p.admin_email = u.email
        WHERE 
            p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $peminjaman_id);
$stmt->execute();
$result = $stmt->get_result();
$peminjaman = $result->fetch_assoc();

if (!$peminjaman) {
    die("Data peminjaman tidak ditemukan.");
}

// Format tanggal ke format Indonesia
function format_tanggal_indonesia($tanggal) {
    if(!$tanggal) return '-';
    $bulan = array (
        1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Peminjaman BMN - #<?= htmlspecialchars($peminjaman['id']) ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            background-color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            border: 1px solid #ccc;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .kop-surat img {
            width: 80px;
            float: left;
        }
        .kop-surat h4, .kop-surat h5 {
            margin: 0;
        }
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
            font-size: 14pt;
        }
        .tanda-tangan {
            margin-top: 60px;
        }
        .tanda-tangan .kolom {
            width: 45%;
            text-align: center;
        }
        .tanda-tangan .kolom-kiri {
            float: left;
        }
        .tanda-tangan .kolom-kanan {
            float: right;
        }
        .nama-terang {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
        .no-print {
            text-align: center;
            margin-top: 30px;
        }

        /* CSS untuk mode cetak */
        @media print {
            body {
                margin: 0;
                border: none;
            }
            .container {
                border: none;
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="kop-surat">
            <img src="assets/img/logobpk.png" alt="Logo BPK">
            <h4>BADAN PEMERIKSA KEUANGAN</h4>
            <h5>REPUBLIK INDONESIA</h5>
            <h5>PERWAKILAN PROVINSI D.I. YOGYAKARTA</h5>
            <p style="font-size: 10pt; margin-top: 5px;">Jalan HOS Cokroaminoto No. 5, Yogyakarta 55244</p>
        </div>

        <div class="judul-surat">
            BERITA ACARA PEMINJAMAN BARANG MILIK NEGARA
        </div>

        <p>Pada hari ini, tanggal <?= format_tanggal_indonesia($peminjaman['tgl_pinjam']) ?>, telah dilaksanakan peminjaman Barang Milik Negara (BMN) oleh:</p>
        <table class="table table-borderless table-sm" style="width: 80%;">
            <tr>
                <td style="width: 30%;">Nama</td>
                <td>: <?= htmlspecialchars($peminjaman['nama_peminjam']) ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: <?= htmlspecialchars($peminjaman['jabatan_peminjam']) ?></td>
            </tr>
             <tr>
                <td>Unit Kerja</td>
                <td>: <?= htmlspecialchars($peminjaman['unit_kerja_peminjam']) ?></td>
            </tr>
        </table>

        <p>Adapun rincian Barang Milik Negara yang dipinjam adalah sebagai berikut:</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Merk/Tipe</th>
                    <th>NUP</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($peminjaman['nama_barang']) ?></td>
                    <td><?= htmlspecialchars($peminjaman['merk']) ?></td>
                    <td><?= htmlspecialchars($peminjaman['nup']) ?></td>
                </tr>
            </tbody>
        </table>

        <p>Barang tersebut dipinjam untuk keperluan dinas dan akan dikembalikan pada tanggal <?= format_tanggal_indonesia($peminjaman['tgl_rencana_kembali']) ?>. Peminjam bertanggung jawab penuh atas kondisi dan keamanan barang selama masa peminjaman.</p>
        <p>Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div class="tanda-tangan">
            <div class="kolom kolom-kiri">
                <p>Yang Meminjam,</p>
                <div class="nama-terang">( <?= htmlspecialchars($peminjaman['nama_peminjam']) ?> )</div>
            </div>
            <div class="kolom kolom-kanan">
                <p>Yogyakarta, <?= format_tanggal_indonesia($peminjaman['tgl_pinjam']) ?></p>
                <p>Yang Menyerahkan,</p>
                <div class="nama-terang">( <?= htmlspecialchars($peminjaman['nama_admin']) ?> )</div>
                <div>NIP. <?= htmlspecialchars($peminjaman['nip_admin']) ?></div>
            </div>
        </div>
    </div>

    <div class="no-print">
        <button class="btn btn-primary" onclick="window.print()">Cetak Surat</button>
        <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
    </div>

</body>
</html>
