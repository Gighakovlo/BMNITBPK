<?php require_once 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Lato:300,400,700,900"] },
        custom: {
          families: [
            "Flaticon",
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/atlantis.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <style>
      .sidebar.sidebar-style-2 .nav.nav-primary .nav-item.active > a {
        background: #d4af37 !important;
      }

      .sidebar.sidebar-style-2 .nav.nav-primary .nav-item.active > a *,
      .sidebar.sidebar-style-2 .nav.nav-primary .nav-item.active > a:hover * {
        color: #ffffff !important;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="main-header">
        <?php require_once 'layout/logo_header.php'; ?>

        <?php require_once 'layout/navbar_header.php'; ?>
      </div>

      <!-- Sidebar -->
      <?php require_once 'layout/sidebar.php'; ?>

      <div class="main-panel">
        <div class="content">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                      <div class="d-flex align-items-center">
                          <h4 class="card-title">Daftar Transaksi Peminjaman</h4>
                          <button id="btn-pinjam-barang" class="btn btn-primary btn-round ml-auto">
                            <i class="fa fa-plus"></i>
                            Pinjamkan Barang
                          </button>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="tabel-peminjaman" class="display table table-striped table-hover" style="width: 100%">
                            <thead>
                              <tr>
                                <th>ID Pinjam</th>
                                <th>Nama Barang</th>
                                <th>Nama Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Rencana Kembali</th>
                                <th>Status</th>
                                <th style="width: 10%">Action</th>
                              </tr>
                            </thead>
                            <tbody id="tabel-peminjaman-body">
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <?php require_once 'layout/footer.php'; ?>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="../assets/js/atlantis.min.js"></script>
<script>
    // --- DEKLARASI VARIABEL ---
    const PEMINJAMAN_API_URL = 'api/peminjaman.php';
    const tabelBody = document.getElementById('tabel-peminjaman-body');
    const btnPinjamBarang = document.getElementById('btn-pinjam-barang');
    let dataTable;

    // --- FUNGSI UTAMA UNTUK MENGISI TABEL TRANSAKSI ---
    function isiTabelPeminjaman() {
        fetch(`${PEMINJAMAN_API_URL}?action=getAll`)
            .then(response => response.json())
            .then(result => {
                if (dataTable) { dataTable.destroy(); }
                tabelBody.innerHTML = '';

                if (result.status === 'sukses' && result.data.length > 0) {
                    result.data.forEach(transaksi => {
                        const baris = document.createElement('tr');
                        
                        let statusBadge;
                        if(transaksi.status === 'Dipinjam') {
                            statusBadge = `<span class="badge badge-warning">${transaksi.status}</span>`;
                        } else if (transaksi.status === 'Dikembalikan') {
                            statusBadge = `<span class="badge badge-success">${transaksi.status}</span>`;
                        } else {
                            statusBadge = `<span class="badge badge-secondary">${transaksi.status}</span>`;
                        }

                        baris.innerHTML = `
                            <td>${transaksi.id}</td>
                            <td>${transaksi.nama_barang}</td>
                            <td>${transaksi.nama_peminjam}</td>
                            <td>${transaksi.tgl_pinjam}</td>
                            <td>${transaksi.tgl_rencana_kembali || '-'}</td>
                            <td>${statusBadge}</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-success btn-kembali" data-id="${transaksi.id}" title="Barang Kembali">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <a href="cetak_surat.php?id=${transaksi.id}" target="_blank" class="btn btn-link btn-primary" title="Cetak Surat">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        `;
                        tabelBody.appendChild(baris);
                    });
                }
                
                dataTable = $('#tabel-peminjaman').DataTable();
            })
            .catch(error => {
                console.error('Error mengambil data:', error);
                tabelBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Gagal memuat data.</td></tr>';
            });
    }

    // --- EVENT LISTENERS ---
    document.addEventListener('DOMContentLoaded', isiTabelPeminjaman);
    
    btnPinjamBarang.addEventListener('click', function() {
        fetch(`${PEMINJAMAN_API_URL}?action=getAvailableItems`)
            .then(response => response.json())
            .then(result => {
                if (result.status === 'sukses') {
                    let optionsHtml = '<option value="">-- Pilih Barang --</option>';
                    if (result.data.length > 0) {
                        result.data.forEach(item => {
                            optionsHtml += `<option value="${item.id}">${item.nama_barang} (${item.merk || 'Tanpa Merk'})</option>`;
                        });
                    } else {
                        optionsHtml = '<option value="">Tidak ada barang yang tersedia</option>';
                    }

                    swal({
                        title: 'Form Peminjaman Barang',
                        content: {
                            element: "div",
                            attributes: {
                                innerHTML: `
                                <div class="form-group text-left"><label>Barang yang Dipinjam</label><select id="swal-bmn-id" class="form-control">${optionsHtml}</select></div>
                                <div class="form-group text-left"><label>Nama Peminjam</label><input id="swal-nama-peminjam" class="form-control" placeholder="Nama Lengkap"></div>
                                <div class="form-group text-left"><label>Jabatan</label><input id="swal-jabatan" class="form-control" placeholder="Jabatan Peminjam"></div>
                                <div class="form-group text-left"><label>Unit Kerja</label><input id="swal-unit-kerja" class="form-control" placeholder="Unit Kerja Peminjam"></div>
                                <div class="form-group text-left"><label>Tanggal Pinjam</label><input id="swal-tgl-pinjam" type="date" class="form-control"></div>
                                <div class="form-group text-left"><label>Rencana Tanggal Kembali</label><input id="swal-tgl-kembali" type="date" class="form-control"></div>
                                `
                            },
                        },
                        buttons: {
                            cancel: { text: "Batal", visible: true, className: "btn btn-danger" },
                            confirm: { text: "Simpan", value: true, className: "btn btn-success" }
                        },
                    }).then((isConfirm) => {
                        if (isConfirm) {
                            const dataToSend = {
                                action: 'create',
                                bmn_item_id: document.getElementById('swal-bmn-id').value,
                                nama_peminjam: document.getElementById('swal-nama-peminjam').value,
                                jabatan_peminjam: document.getElementById('swal-jabatan').value,
                                unit_kerja_peminjam: document.getElementById('swal-unit-kerja').value,
                                tgl_pinjam: document.getElementById('swal-tgl-pinjam').value,
                                tgl_rencana_kembali: document.getElementById('swal-tgl-kembali').value,
                                admin_email: sessionStorage.getItem('userEmail')
                            };

                            fetch(PEMINJAMAN_API_URL, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(dataToSend)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'sukses') {
                                    swal("Berhasil!", "Data peminjaman berhasil disimpan.", "success", { buttons: false, timer: 2000 });
                                    isiTabelPeminjaman(); // Muat ulang tabel
                                } else {
                                    swal("Gagal!", data.message || "Terjadi kesalahan.", "error");
                                }
                            });
                        }
                    });
                } else {
                    swal("Error", "Gagal mengambil daftar barang.", "error");
                }
            });
    });

       // --- PERBAIKAN: LOGIKA UNTUK TOMBOL KEMBALI ---
    tabelBody.addEventListener('click', function(event) {
        const tombolKembali = event.target.closest('.btn-kembali');
        if (tombolKembali) {
            const peminjamanId = tombolKembali.dataset.id;

            swal({
                title: 'Konfirmasi Pengembalian',
                text: "Apakah Anda yakin barang ini sudah dikembalikan?",
                icon: 'warning',
                buttons: {
                    cancel: { text: "Batal", visible: true, className: "btn btn-info" },
                    confirm: { text: "Ya, Sudah Kembali", value: true, className: "btn btn-success" }
                }
            }).then((isConfirm) => {
                if (isConfirm) {
                    fetch(PEMINJAMAN_API_URL, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ 
                            action: 'markAsReturned', 
                            peminjaman_id: peminjamanId,
                            admin_email: sessionStorage.getItem('userEmail') // Untuk logging nanti
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            swal("Berhasil!", "Status barang berhasil diperbarui.", "success", { buttons: false, timer: 2000 });
                            isiTabelPeminjaman(); // Muat ulang tabel untuk melihat perubahan
                        } else {
                            swal("Gagal!", data.message, "error");
                        }
                    });
                }
            });
        }
    });
</script>

  </body>
</html>
