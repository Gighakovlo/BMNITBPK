<!-- Navbar Header -->
        <nav
          id="navbar-bpk"
          class="navbar navbar-header navbar-expand-lg brown-bg"
          style="background-color: #d4af37 !important"
        >
          <div class="container-fluid">
            <div class="collapse" id="search-nav"></div>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
              <li class="nav-item dropdown hidden-caret">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="notifDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fa fa-bell"></i>
                  <span class="notification">4</span>
                </a>
                <ul
                  class="dropdown-menu notif-box animated fadeIn"
                  aria-labelledby="notifDropdown"
                >
                  <li>
                    <div class="dropdown-title">
                      You have 4 new notification
                    </div>
                  </li>
                  <li>
                    <div class="notif-scroll scrollbar-outer">
                      <div class="notif-center">
                        <a href="#">
                          <div class="notif-icon notif-primary">
                            <i class="fa fa-user-plus"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block"> New user registered </span>
                            <span class="time">5 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-icon notif-success">
                            <i class="fa fa-comment"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block">
                              Rahmad commented on Admin
                            </span>
                            <span class="time">12 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-img">
                            <img
                              src="../assets/img/profile2.jpg"
                              alt="Img Profile"
                            />
                          </div>
                          <div class="notif-content">
                            <span class="block">
                              Reza send messages to you
                            </span>
                            <span class="time">12 minutes ago</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="notif-icon notif-danger">
                            <i class="fa fa-heart"></i>
                          </div>
                          <div class="notif-content">
                            <span class="block"> Farrah liked Admin </span>
                            <span class="time">17 minutes ago</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a class="see-all" href="javascript:void(0);"
                      >See all notifications<i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-toggle="dropdown"
                  href="#"
                  aria-expanded="false"
                >
                  <div class="avatar-sm">
                    <img
                      src="../assets/img/profile.jpg"
                      alt="..."
                      class="avatar-img rounded-circle profile-pic-header"
                    />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                            <img src="<?= $profile_pic_url ?>" alt="image profile" class="avatar-img rounded profile-pic-header">
                        </div>
                        <div class="u-text">
                            <h4 id="profile-dropdown-username">
                                <?= htmlspecialchars($_SESSION['user_data']['nama_lengkap'] ?? $_SESSION['user_email']) ?>
                            </h4>
                            <p id="profile-dropdown-email" class="text-muted">
                                <?= htmlspecialchars($_SESSION['user_email']) ?>
                            </p>
                            <a href="view-profile.php" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                        </div>
                    </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="account-setting.html"
                        >Account Setting</a
                      >
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Logout</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->