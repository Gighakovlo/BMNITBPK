<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART-BMN - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Inter', sans-serif;
    }
    .main-container {
      display: flex;
      min-height: 100vh;
      width: 100%;
    }
    .image-container {
      flex: 1;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: none;
      position: relative;
    }
    .image-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.3);
    }
    .logo-bpk {
      width: 120px;
      height: 120px;
      margin-bottom: 2rem;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
      animation: fadeInUp 1s ease-out;
    }
    .welcome-content {
      animation: fadeInUp 1s ease-out 0.3s both;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .form-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      background: #f8f9fa;
    }
    .form-box {
      width: 100%;
      max-width: 400px;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .btn-login {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      color: white;
      transition: all 0.3s ease;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      color: white;
    }
    .loading {
      pointer-events: none;
      opacity: 0.6;
    }
    @media (min-width: 768px) {
      .image-container {
        display: block;
      }
    }
  </style>
</head>
<body>

  <div class="main-container">
    <div class="image-container">
      <div class="d-flex justify-content-center align-items-center h-100 position-relative" style="z-index: 1;">
        <div class="text-center text-white">
          <!-- Logo BPK -->
          <img src="assets/img/lambang-bpk.png" alt="Logo BPK" class="logo-bpk">
          
          <!-- Welcome Content -->
          <div class="welcome-content">
            <h1 class="h3 fw-bold mb-3">Badan Pemeriksa Keuangan RI</h1>
            <div class="d-flex align-items-center justify-content-center mb-3">
              <i class="bi bi-shield-check me-2" style="font-size: 2rem;"></i>
              <h2 class="h2 fw-bold mb-0">SMART-BMN</h2>
            </div>
            <p class="lead mb-2">Sistem Manajemen Aset & Registrasi Teknologi</p>
            <p class="text-white-50">Solusi digital untuk pengelolaan aset negara yang lebih efisien</p>
          </div>
        </div>
      </div>
    </div>

    <div class="form-container">
      <div class="form-box">
        <div class="text-center mb-4">
            <img src="assets/img/lambang-bpk.png" alt="Logo BPK" style="width: 80px; margin-bottom: 1rem;">
            <h1 class="h5 fw-bold mb-1">Badan Pemeriksa Keuangan RI</h1>
            <h2 class="h4 fw-bold mb-2 mt-2">SMART-BMN</h2>
            <p class="text-secondary mb-1">Sistem Manajemen Aset & Registrasi Teknologi</p>
            <p class="text-muted small">Login untuk mengakses sistem</p>
        </div>

        <div id="alert-container"></div>

        <form id="loginForm">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="email">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="rememberMe">
              <label class="form-check-label" for="rememberMe">
                Ingat saya
              </label>
            </div>
          </div>
          <div class="d-grid">
            <button class="btn btn-login btn-lg" type="submit" id="loginBtn">
              <span class="btn-text">Masuk</span>
              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const loginForm = document.getElementById('loginForm');
const alertContainer = document.getElementById('alert-container');
const loginBtn = document.getElementById('loginBtn');
const spinner = loginBtn.querySelector('.spinner-border');
const btnText = loginBtn.querySelector('.btn-text');

// Fungsi untuk menampilkan alert (tidak berubah)
function showAlert(message, type = 'danger') {
  alertContainer.innerHTML = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;
}

// Fungsi untuk mengatur loading state (tidak berubah)
function setLoading(isLoading) {
  if (isLoading) {
    loginBtn.classList.add('loading');
    spinner.classList.remove('d-none');
    btnText.textContent = 'Memproses...';
    loginBtn.disabled = true;
  } else {
    loginBtn.classList.remove('loading');
    spinner.classList.add('d-none');
    btnText.textContent = 'Masuk';
    loginBtn.disabled = false;
  }
}

// Event listener untuk form login
loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        setLoading(true);
        alertContainer.innerHTML = '';

        // Menggunakan FormData untuk mengirim data ke PHP
        const formData = new FormData(loginForm);

        fetch('api/login_process.php', { // <-- URL API BARU
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'sukses') {
                showAlert('Login berhasil! Mengalihkan ke dashboard...', 'success');

                // Arahkan ke dashboard yang sesuai
                setTimeout(() => {
                    if (result.role === 'superadmin') {
                        window.location.href = 'superadmin_dashboard.php'; // Ganti ke .php
                    } else {
                        window.location.href = 'index.php'; // Ganti ke .php
                    }
                }, 1500);
            } else {
                showAlert(result.message || 'Email atau password salah!');
                setLoading(false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan koneksi. Cek console.');
            setLoading(false);
        });
    });

</script>
</body>
</html>