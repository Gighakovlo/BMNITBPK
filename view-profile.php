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
    <link rel="stylesheet" href="../assets/css/tambahbarang.css" />

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
                    <div class="card-title">Informasi Akun</div>
                    
                  </div>
                  <div class="card-body">
                    <div
                      class="d-flex flex-column align-items-center text-center"
                    >
                      <img
                        src="https://placehold.co/150"
                        alt="Admin"
                        class="rounded-circle"
                        width="150"
                        id="profile-picture"
                      />
                      <div class="mt-3">
                        <h4 id="profile-nama">Nama Lengkap</h4>
                        <p class="text-secondary mb-1" id="profile-jabatan">
                          Jabatan
                        </p>
                        <p
                          class="text-muted font-size-sm"
                          id="profile-penempatan"
                        >
                          Penempatan
                        </p>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                      <div class="col-sm-9 text-secondary" id="profile-email">
                        email@contoh.com
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm-3"><h6 class="mb-0">NIP</h6></div>
                      <div class="col-sm-9 text-secondary" id="profile-nip">
                        -
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">No. Telepon</h6>
                      </div>
                      <div class="col-sm-9 text-secondary" id="profile-noTelp">
              
                      </div>
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
      const API_URL =
        "https://script.google.com/macros/s/AKfycby_TxSIHg3z9e9W9MQL6xroa_XKjtSvwfR7NI1a5I922Uoa4Lhai26mY9e6btpQSUh-/exec"; // <-- PASTIKAN INI URL ANDA
      document.addEventListener('DOMContentLoaded', function() {
        const userEmail = sessionStorage.getItem('userEmail');
        if (userEmail) {
            fetch(`${API_URL}?action=getProfile&email=${userEmail}`)
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'sukses') {
                        const data = result.data;
                        document.getElementById('profile-nama').textContent = data[2] || '-';
                        document.getElementById('profile-jabatan').textContent = data[4] || '-';
                        document.getElementById('profile-penempatan').textContent = data[6] || '-';
                        document.getElementById('profile-email').textContent = data[0] || '-';
                        document.getElementById('profile-nip').textContent = data[3] || '-';
                        document.getElementById('profile-noTelp').textContent = data[8] || '-';
                        
                        // ===== TAMBAHKAN BARIS INI =====
                        const idFotoProfil = data[9];
                        if (idFotoProfil) {
                            document.getElementById('profile-picture').src = `https://drive.google.com/thumbnail?id=${idFotoProfil}&sz=w200`;
                        }
                    }
                });
        }
    });
    </script>
  </body>
</html>
