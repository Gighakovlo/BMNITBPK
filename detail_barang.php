<?php require_once 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<link rel="stylesheet" href="../assets/css/detailbarang.css"> 

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<style>
    .thumbnail {
        width: 100px; height: 100px; object-fit: cover;
        cursor: pointer; opacity: 0.6; transition: opacity 0.2s;
    }
    .thumbnail:hover { opacity: 1; }
    .thumbnail.active { opacity: 1; border: 2px solid #0d6efd; }
    .thumbnail-container { display: flex; gap: 10px; }
	</style>
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

		<?php require_once 'layout/sidebar.php'; ?>

		<!-- Main Panel -->
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
							<div class="col-md-6 mb-4">
								<img src="https://placehold.co/600x400?text=Memuat+Gambar..." alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
								<div id="thumbnail-container" class="d-flex justify-content-start flex-wrap" style="gap: 10px;">
								</div>
							</div>
							<div class="col-md-6">
								<h2 class="mb-3"></h2>
								<p class="text-muted mb-4"></p>
								<p class="mb-4">Experience premium sound quality and industry-leading noise cancellation with these wireless
									headphones. Perfect for music lovers and frequent travelers.</p>
								
							
								<div class="mt-4">
									<h5>Key Features:</h5>
									<ul>
										<li>Industry-leading noise cancellation</li>
										<li>30-hour battery life</li>
										<li>Touch sensor controls</li>
										<li>Speak-to-chat technology</li>
									</ul>
								</div>
								<div class="mt-4">
									<a href="#" id="btn-edit" class="btn btn-warning btn-lg">
										<i class="fas fa-edit"></i> Edit Data
									</a>
								</div>
							</div>
						</div>
					<div class="page-category">Inner page content goes here</div>
				</div>
			</div>
			
	  		<?php require_once 'layout/sidebar.php'; ?>
			
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
function changeImage(event, src) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    event.target.classList.add('active');
}
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const API_URL = 'api/bmn_data.php';

        // Ambil ID dari parameter URL
        const params = new URLSearchParams(window.location.search);
        const idAset = params.get('id');

        if (idAset) {
            fetch(`${API_URL}?id=${idAset}`)
                .then(response => response.json())
                .then(barang => {
                    if (barang && !barang.error) {
                        // Ganti konten halaman dengan data yang diterima
                        document.querySelector('h2.mb-3').textContent = barang.nama_barang;
                        document.querySelector('p.text-muted.mb-4').textContent = `NUP: ${barang.nup || 'Tidak ada'}`;
                        
                        // Isi Key Features
                        const featuresList = document.querySelector('.mt-4 ul');
                        featuresList.innerHTML = `
                            <li><strong>ID Aset:</strong> ${barang.id_barang}</li>
                            <li><strong>Merk:</strong> ${barang.merk}</li>
                            <li><strong>Kondisi:</strong> ${barang.kondisi}</li>
                            <li><strong>Lokasi:</strong> ${barang.lokasi}</li>
                            <li><strong>Tanggal Perolehan:</strong> ${barang.tgl_perolehan}</li>
                        `;

                    } else {
                        document.querySelector('h2.mb-3').textContent = 'Data Tidak Ditemukan';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
</body>
</html>