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
	<link rel="stylesheet" href="../assets/css/tambahbarang.css" />

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
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
						<div class="card">
							<div class="card-header">
							<div class="card-title">Form Edit Barang Baru</div>
							<div class="card-category">Edit semua data yang diperlukan di bawah ini</div>
							</div>
							<div class="card-body">
							<form id="form-edit-barang">
								<input type="hidden" name="id" id="itemId">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nup">NUP</label>
											<input type="text" class="form-control" id="nup" name="nup" placeholder="Masukkan NUP">
										</div>
										<div class="form-group">
											<label for="namaBarang">Nama Barang</label>
											<input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
										</div>
										<div class="form-group">
											<label for="merk">Merk / Tipe</label>
											<input type="text" class="form-control" id="merk" name="merk">
										</div>
										<div class="form-group">
											<label for="kondisi">Kondisi</label>
											<select class="form-control" id="kondisi" name="kondisi">
												<option>Baik</option>
												<option>Rusak Ringan</option>
												<option>Rusak Berat</option>
											</select>
										</div>
										<div class="form-group">
											<label for="umurAset">Umur Aset (Tahun)</label>
											<input type="number" class="form-control" id="umurAset" name="umurAset">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="tglBuku">Tanggal Buku Pertama</label>
											<input type="date" class="form-control" id="tglBuku" name="tglBuku">
										</div>
										<div class="form-group">
											<label for="tglPerolehan">Tanggal Perolehan</label>
											<input type="date" class="form-control" id="tglPerolehan" name="tglPerolehan">
										</div>
										<div class="form-group">
											<label for="nilaiAset">Nilai Perolehan Pertama</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
												<input type="number" class="form-control" id="nilaiAset" name="nilaiAset">
											</div>
										</div>
										<div class="form-group">
											<label for="lokasi">Lokasi</label>
											<input type="text" class="form-control" id="lokasi" name="lokasi">
										</div>
										<div class="form-group">
											<label for="fotoLink">Link Folder Foto Google Drive</label>
											<input type="text" class="form-control" id="fotoLink" name="fotoLink">
										</div>
									</div>
								</div>
							</form>
							</div>
							<div class="card-action">
							<button type="submit" form="form-edit-barang" class="btn btn-success" id="btn-simpan">Simpan Data</button>
							<button type="button" class="btn btn-danger" id="btn-batal">Batal</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // --- DEKLARASI SEMUA ELEMEN SETELAH HALAMAN SIAP ---
        const form = document.getElementById('form-edit-barang');
        const submitButton = document.getElementById('btn-simpan');
        const batalButton = document.getElementById('btn-batal');
        const params = new URLSearchParams(window.location.search);
        const itemId = params.get('id');

        // --- BAGIAN 1: Mengambil & mengisi form dengan data lama ---
        if (itemId) {
            fetch(`api/bmn_data.php?id=${itemId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(item => {
                    if (item && !item.error) {
                        // Isi semua field
                        document.getElementById('itemId').value = item.id;
                        document.getElementById('nup').value = item.nup;
                        document.getElementById('namaBarang').value = item.nama_barang;
                        document.getElementById('merk').value = item.merk;
                        document.getElementById('kondisi').value = item.kondisi;
                        document.getElementById('umurAset').value = item.umur_aset;
                        document.getElementById('tglBuku').value = item.tgl_buku_pertama;
                        document.getElementById('tglPerolehan').value = item.tgl_perolehan;
                        document.getElementById('nilaiAset').value = item.nilai_perolehan;
                        document.getElementById('lokasi').value = item.lokasi;
                        document.getElementById('fotoLink').value = item.foto_link;
                    } else {
                        swal("Error", "Data untuk ID " + itemId + " tidak ditemukan.", "error");
                    }
                })
                .catch(error => {
                    console.error('Error saat mengambil data:', error);
                    swal("Error", "Gagal memuat data untuk diedit. Cek console.", "error");
                });
        }

        // --- BAGIAN 2: Mengirim perubahan saat form disubmit ---
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const originalButtonText = "Simpan Perubahan";
            submitButton.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Menyimpan...`;
            submitButton.disabled = true;

            const dataToSend = {
                id: document.getElementById('itemId').value,
                nup: document.getElementById('nup').value,
                namaBarang: document.getElementById('namaBarang').value,
                merk: document.getElementById('merk').value,
                kondisi: document.getElementById('kondisi').value,
                umurAset: document.getElementById('umurAset').value,
                tglBuku: document.getElementById('tglBuku').value,
                tglPerolehan: document.getElementById('tglPerolehan').value,
                nilaiAset: document.getElementById('nilaiAset').value,
                lokasi: document.getElementById('lokasi').value,
                fotoLink: document.getElementById('fotoLink').value
            };

            fetch('api/update_bmn.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dataToSend)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "sukses") {
                    swal({
                        title: 'Berhasil!',
                        text: 'Data telah berhasil diperbarui.',
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    }).then(() => {
                        window.location.href = `detail_barang.php?id=${dataToSend.id}`;
                    });
                } else {
                    swal('Gagal', 'Terjadi kesalahan: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error saat menyimpan data:', error);
                swal('Error', 'Gagal terhubung ke server saat menyimpan. Cek console.', 'error');
            })
            .finally(() => {
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;
            });
        });

        // --- BAGIAN 3: Fungsionalitas Tombol Batal ---
        batalButton.addEventListener('click', function() {
            swal({
                title: 'Apakah Anda Yakin?',
                text: "Perubahan yang belum disimpan akan hilang.",
                icon: 'warning',
                buttons: {
                    cancel: { text: "Kembali", value: null, visible: true, className: "btn btn-info" },
                    confirm: { text: "Ya, Batalkan", value: true, visible: true, className: "btn btn-danger" }
                }
            }).then((isConfirm) => {
                if (isConfirm) {
                    // Kembali ke halaman tabel utama
                    window.location.href = 'tabel-edit-barang.php';
                }
            });
        });
    });
</script>
</body>
</html>