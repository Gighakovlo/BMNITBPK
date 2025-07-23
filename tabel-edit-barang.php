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
                      <h4 class="card-title">Data Barang Milik Negara</h4>

                      <button
                        id="btn-select-mode"
                        class="btn btn-info btn-round ml-auto"
                      >
                        <i class="fas fa-check-square"></i> Pilih
                      </button>
                      <a
                        href="tambah-barang.html"
                        id="btn-tambah"
                        class="btn btn-primary btn-round ml-2"
                      >
                        <i class="fa fa-plus"></i> Tambah Barang
                      </a>
                      <button
                        id="btn-hapus-terpilih"
                        class="btn btn-danger btn-round ml-auto"
                        style="display: none"
                      >
                        <i class="fa fa-trash"></i> Hapus Barang Terpilih
                      </button>
                      <button
                        id="btn-batal-select"
                        class="btn btn-secondary btn-round ml-2"
                        style="display: none"
                      >
                        Batal
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table
                      id="tabel-bmn-manage"
                      class="display table table-striped table-hover"
                      style="width: 100%"
                    >
                      <thead>
                          <tr>
                              <th style="width: 5%; display:none;"><input type="checkbox" id="select-all-checkbox"></th>
                              <th>ID Aset</th>
                              <th>Nama Barang</th>
                              <th>Merk</th>
                              <th>Kondisi</th>
                              <th>Lokasi</th>
                              <th style="width: 10%">Action</th>
                          </tr>
                      </thead>
                      <tbody id="tabel-bmn-body"></tbody>
                    </table>
                    </div>
                  </div>
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
    // --- DEKLARASI VARIABEL GLOBAL ---
    const API_URL = 'api/bmn_data.php'; // Ganti ke API PHP Anda
    const DELETE_API_URL = 'api/delete_bmn.php'; // URL khusus untuk hapus data
    const tabelBody = document.getElementById('tabel-bmn-body');
    // Referensi tombol-tombol header
    const btnTambah = document.getElementById('btn-tambah');
    const btnSelectMode = document.getElementById('btn-select-mode');
    const btnHapusTerpilih = document.getElementById('btn-hapus-terpilih');
    const btnBatalSelect = document.getElementById('btn-batal-select');
    const selectAllCheckbox = document.getElementById('select-all-checkbox');

    let isSelectionMode = false;
    let dataTable; // Variabel untuk menyimpan instance DataTables

    // --- FUNGSI UNTUK MENGATUR TAMPILAN MODE SELEKSI ---
    function toggleSelectionUI() {
        isSelectionMode = !isSelectionMode;

        // Tampilkan/sembunyikan tombol di header
        btnTambah.style.display = isSelectionMode ? 'none' : 'inline-block';
        btnSelectMode.style.display = isSelectionMode ? 'none' : 'inline-block';
        btnHapusTerpilih.style.display = isSelectionMode ? 'inline-block' : 'none';
        btnBatalSelect.style.display = isSelectionMode ? 'inline-block' : 'none';

        // Tampilkan/sembunyikan sel header checkbox secara manual
        selectAllCheckbox.parentElement.style.display = isSelectionMode ? '' : 'none';

        // Perintahkan DataTables untuk menampilkan/menyembunyikan kolom
        if (dataTable) {
            dataTable.column(0).visible(isSelectionMode);  // Kolom Checkbox (indeks 0)
            dataTable.column(6).visible(!isSelectionMode); // Kolom Action (indeks 6)
        }

        if (!isSelectionMode) {
            selectAllCheckbox.checked = false;
            // Gunakan API DataTables untuk mereset checkbox di semua halaman
            if(dataTable) {
                 dataTable.rows().nodes().to$().find('.row-checkbox').prop('checked', false);
            }
        }
    }

    // --- FUNGSI UTAMA UNTUK MENGISI TABEL ---
    function isiTabel() {
        fetch(API_URL)
            .then(response => response.json())
            .then(dataBarang => {
                if (dataTable) { dataTable.destroy(); }
                tabelBody.innerHTML = '';

                dataBarang.forEach(barang => {
                    const baris = document.createElement('tr');
                    baris.innerHTML = `
                        <td><input type="checkbox" class="row-checkbox" data-id="${barang.id}"></td>
                        <td>${barang.id}</td>
                        <td>${barang.nama_barang}</td>
                        <td>${barang.merk}</td>
                        <td>${barang.kondisi}</td>
                        <td>${barang.lokasi}</td>
                        <td>
                            <div class="form-button-action">
                                <a href="edit_barang.php?id=${barang.id}" class="btn btn-link btn-primary btn-lg" title="Edit Data">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-link btn-danger btn-delete" data-id="${barang.id}" data-nama="${barang.nama_barang}" title="Hapus Data">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    `;
                    tabelBody.appendChild(baris);
                });

                dataTable = $('#tabel-bmn-manage').DataTable({
                    "columnDefs": [
                        { "targets": [0], "visible": false, "orderable": false }, // Checkbox
                        { "targets": [6], "orderable": false } // Action
                    ]
                });
            })
            .catch(error => console.error('Error mengambil data:', error));
    }

    // --- EVENT LISTENERS ---
    document.addEventListener('DOMContentLoaded', isiTabel);
    
    btnSelectMode.addEventListener('click', toggleSelectionUI);
    btnBatalSelect.addEventListener('click', toggleSelectionUI);

    selectAllCheckbox.addEventListener('click', function() {
        // Gunakan API DataTables untuk memilih semua checkbox di semua halaman
        const rows = dataTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    btnHapusTerpilih.addEventListener('click', function() {
        const idsToDelete = [];
        // Gunakan API DataTables untuk mendapatkan semua checkbox yang terpilih
        dataTable.$('.row-checkbox:checked').each(function() {
            idsToDelete.push($(this).data('id'));
        });

        if (idsToDelete.length === 0) {
          "Tidak Ada Data Terpilih",
          "Silakan pilih setidaknya satu barang untuk dihapus.",
          "warning"
        };
        return swal({
          title: "Apakah Anda Yakin?",
          text: `Anda akan menghapus ${idsToDelete.length} data barang secara permanen!`,
          icon: "warning",
          buttons: {
            cancel: {
              text: "Batal",
              value: null,
              visible: true,
              className: "btn btn-info",
            },
            confirm: {
              text: "Ya, Hapus Semua",
              value: true,
              visible: true,
              className: "btn btn-danger",
            },
          },
        })
        .then(willDelete => {
            if (willDelete) {
                fetch(DELETE_API_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ids: idsToDelete })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'sukses') {
                        swal("Berhasil!", data.message, "success", { buttons: false, timer: 2000 });
                        toggleSelectionUI();
                        isiTabel(); // Muat ulang data tabel
                    } else {swal(
                    "Gagal!",
                    "Data gagal dihapus. " + data.message,
                    "error"
                  );}
                }).catch(err => {swal("Error!", "Gagal terhubung ke server.", "error");
              });
            }
        });
    });

    tabelBody.addEventListener('click', function(event) {
    // Cari apakah yang diklik adalah tombol hapus
    const deleteButton = event.target.closest('.btn-delete');
    
    // Jika bukan, abaikan
    if (!deleteButton) {
        return;
    }

    const idToDelete = deleteButton.dataset.id;
    const namaBarang = deleteButton.dataset.nama;

    // Tampilkan notifikasi konfirmasi
    swal({
        title: 'Apakah Anda Yakin?',
        text: `Data untuk "${namaBarang}" (ID: ${idToDelete}) akan dihapus secara permanen!`,
        icon: 'warning',
        buttons: {
            cancel: { text: "Batal", value: null, visible: true, className: "btn btn-info" },
            confirm: { text: "Ya, Hapus", value: true, visible: true, className: "btn btn-danger" }
        }
    }).then((willDelete) => {
        if (willDelete) {
            // Jika dikonfirmasi, kirim perintah hapus ke API
            fetch(DELETE_API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'delete', id: idToDelete })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'sukses') {
                    swal("Berhasil!", "Data telah berhasil dihapus.", "success", { buttons: false, timer: 1500 });
                    // Hapus baris dari tabel tanpa perlu refresh
                    dataTable.row(deleteButton.closest('tr')).remove().draw();
                } else {
                    swal("Gagal!", "Data gagal dihapus. " + data.message, "error");
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                swal("Error!", "Gagal terhubung ke server.", "error");
            });
        }
    });
});
</script>
  </body>
</html>
