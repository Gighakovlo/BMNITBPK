<!-- Sidebar -->
      <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <div class="user">
              <div class="avatar-sm float-left mr-2">
                <img
                  src="../assets/img/profile.jpg"
                  alt="..."
                  class="avatar-img rounded-circle profile-pic-header"
                />
              </div>
              <div class="info">
                  <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        <span id="sidebar-username">
                            <?= htmlspecialchars($_SESSION['user_data']['nama_lengkap'] ?? $_SESSION['user_email']) ?>
                        </span>
                        <span id="sidebar-userlevel" class="user-level">
                            <?= htmlspecialchars(ucfirst($_SESSION['user_role'])) ?>
                        </span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse in" id="collapseExample">
                  <ul class="nav">
                    <li>
                      <a href="view-profile.php">
                        <span class="link-collapse">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a href="account-setting.php">
                        <span class="link-collapse">Edit Profile</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <ul class="nav nav-primary">
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>

              <li class="nav-item">
                <a href="detail_barang.php">
                  <i class="fas fa-box"></i>
                  <p>Detail Barang</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="tambah-barang.php">
                  <i class="fas fa-box"></i>
                  <p>Tambah Barang</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="tabel-edit-barang.php">
                  <i class="fas fa-table"></i>
                  <p>Edit Barang</p>
                </a>
              </li>
              <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'superadmin'): ?>
                <li class="nav-item" id="menu-superadmin">
                    <a href="superadmin_dashboard.php">
                        <i class="fas fa-users-cog"></i>
                        <p>Manage Admin</p>
                    </a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->