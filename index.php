<?php require_once 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>BPK Manajemen BMN</title>
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

      <?php require_once 'layout/sidebar.php'; ?>      

      <div class="main-panel">
        <div class="content">
          <div class="panel-header bg-primary-gradient">
            <div
              class="page-inner py-5"
              style="background-color: #d4af37 !important"
            >
              <div
                class="d-flex align-items-left align-items-md-center flex-column flex-md-row"
              >
                <div>
                  <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                  <h5 class="text-white op-7 mb-2">Dashboard Manajemen BMN</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0"></div>
              </div>
            </div>
          </div>
          <div class="page-inner mt--5">
            <div class="row mt--2">
              <div class="col-md-6"></div>
              <div class="col-md-6"></div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Data Barang Milik Negara (BMN)</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="tabel-bmn" class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID Aset</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Lokasi</th>
                          </tr>
                        </thead>
                        <tbody id="tabel-bmn-body"></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4"></div>
            </div>

            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4"></div>
              <div class="col-md-4"></div>
            </div>
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6"></div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const API_URL = 'api/bmn_data.php';
        const tabelBody = document.getElementById("tabel-bmn-body");
        
        tabelBody.innerHTML = '<tr><td colspan="5" style="text-align:center;">Mengambil data...</td></tr>';

        fetch(API_URL)
            .then(response => response.json())
            .then(dataBarang => {
                tabelBody.innerHTML = "";
                
                dataBarang.forEach(barang => {
                    const baris = document.createElement("tr");
                    baris.style.cursor = "pointer";
                    baris.onclick = function () {
                        // Pastikan nama file ini benar (misal: detail_barang.php)
                        window.location.href = `detail_barang.php?id=${barang.id}`;
                    };

                    baris.innerHTML = `
                        <td>${barang.id}</td>
                        <td>${barang.nama_barang}</td>
                        <td>${barang.merk}</td>
                        <td>${barang.kondisi}</td>
                        <td>${barang.lokasi}</td>
                    `;
                    tabelBody.appendChild(baris);
                });
                
                // Inisialisasi DataTables
                $('#tabel-bmn').DataTable();
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
                tabelBody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:red;">Gagal memuat data.</td></tr>';
            });
    });
</script>
  </body>
</html>
