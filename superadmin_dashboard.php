<?php require_once 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">

	<style>
      .sidebar.sidebar-style-2 .nav.nav-primary .nav-item.active > a {
        background: #D4AF37 !important;
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
								<h4 class="card-title">Manajemen Akses Admin</h4>
								<button class="btn btn-primary btn-round ml-auto" id="btn-tambah-admin">
								<i class="fa fa-plus"></i>
								Tambah Admin
								</button>
							</div>
							</div>
							<div class="card-body">
							<div class="table-responsive">
								<table id="tabel-admin" class="display table table-hover" style="width: 100%;">
								<thead>
									<tr>
									<th>Email Admin</th>
									<th style="width: 10%">Action</th>
									</tr>
								</thead>
								<tbody id="tabel-admin-body">
									</tbody>
								</table>
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
    const API_URL = 'https://script.google.com/macros/s/AKfycby_TxSIHg3z9e9W9MQL6xroa_XKjtSvwfR7NI1a5I922Uoa4Lhai26mY9e6btpQSUh-/exec'; // <-- PASTIKAN INI URL ANDA
    const tabelBody = document.getElementById('tabel-admin-body');

    // --- FUNGSI UNTUK MEMUAT ULANG DAFTAR ADMIN ---
    function muatDaftarAdmin() {
        fetch(`${API_URL}?view=admins`)
            .then(response => response.json())
            .then(result => {
                if (result.status === 'sukses') {
                    tabelBody.innerHTML = ''; // Kosongkan tabel
                    result.data.forEach(email => {
                        const baris = document.createElement('tr');
                        baris.innerHTML = `
                            <td>${email}</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-danger btn-delete-admin" data-email="${email}" title="Hapus Admin">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        `;
                        tabelBody.appendChild(baris);
                    });
                }
            })
            .catch(err => console.error('Error mengambil daftar admin:', err));
    }

    // --- FUNGSI UTAMA YANG BERJALAN SAAT HALAMAN DIMUAT ---
    document.addEventListener('DOMContentLoaded', function() {
        const userRole = sessionStorage.getItem('userRole');
        if (userRole !== 'superadmin') {
            alert('Akses ditolak. Hanya Super Admin yang bisa mengakses halaman ini.');
            window.location.href = 'index.php';
            return;
        }

        const menuSuperAdmin = document.getElementById('menu-superadmin');
        if(menuSuperAdmin) menuSuperAdmin.style.display = 'block';

        // Panggil fungsi untuk mengisi tabel saat halaman pertama kali dimuat
        muatDaftarAdmin();
    });

    // === BAGIAN BARU: EVENT LISTENER UNTUK TOMBOL TAMBAH ADMIN ===
    const btnTambahAdmin = document.getElementById('btn-tambah-admin');

    btnTambahAdmin.addEventListener('click', function() {
        swal({
            title: 'Tambah Admin Baru',
            // Kita gunakan SweetAlert untuk membuat form input
            content: {
                element: "div",
                attributes: {
                    innerHTML: `
                        <div class="form-group">
                            <input type="email" id="swal-input-email" class="form-control" placeholder="Email Admin">
                        </div>
                        <div class="form-group">
                            <input type="password" id="swal-input-password" class="form-control" placeholder="Password Awal">
                        </div>
                    `
                },
            },
           buttons: {
				cancel: {
					text: "Batal",
					value: null,
					visible: true,
					className: "btn btn-danger", // <-- Kita tambahkan kelas ini
					closeModal: true,
				},
				confirm: {
					text: "Simpan",
					value: true,
					visible: true,
					className: "btn btn-success",
					closeModal: true
				}
			},
        }).then((isConfirm) => {
            if (isConfirm) {
                const email = document.getElementById('swal-input-email').value;
                const password = document.getElementById('swal-input-password').value;

                if (!email || !password) {
                    swal("Gagal!", "Email dan Password tidak boleh kosong.", "error");
                    return;
                }

                // Kirim data admin baru ke API
                fetch(API_URL, {
                    method: 'POST',
                    body: JSON.stringify({ action: 'tambahAdmin', email: email, password: password })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'sukses'){
                        swal("Berhasil!", "Admin baru telah berhasil ditambahkan.", "success", { buttons: false, timer: 2000 });
                        // Muat ulang daftar admin untuk menampilkan data baru
                        muatDaftarAdmin();
                    } else {
                        swal("Gagal!", "Terjadi kesalahan: " + data.message, "error");
                    }
                }).catch(err => swal("Error!", "Gagal terhubung ke server.", "error"));
            }
        });
    });
</script>
</body>
</html>