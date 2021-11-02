<div class="header">
  <!-- Logo -->
  <div class="header-left">
    <a href="index.php" class="logo">
      <img src="assets/img/logo.png" alt="Logo" />
    </a>
    <a href="index.php" class="logo logo-small">
      <img src="assets/img/logo-small.png" alt="Logo" width="30" height="30" />
    </a>
  </div>
  <!-- /Logo -->

  <!-- Sidebar Toggle -->
  <a href="javascript:void(0);" id="toggle_btn">
    <i class="fas fa-bars"></i>
  </a>
  <!-- /Sidebar Toggle -->

  <!-- Search -->
  <div class="top-nav-search">
    <form>
      <input type="text" class="form-control" placeholder="Search here" />
      <button class="btn" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>
  <!-- /Search -->

  <!-- Mobile Menu Toggle -->
  <a class="mobile_btn" id="mobile_btn">
    <i class="fas fa-bars"></i>
  </a>
  <!-- /Mobile Menu Toggle -->

  <!-- Header Menu -->
  <ul class="nav user-menu">
    <!-- Flag -->

    <!-- /Flag -->

    <!-- Notifications -->
    <li class="nav-item dropdown">
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="feather feather-bell">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span class="badge badge-pill">5</span>
      </a>
      <div class="dropdown-menu notifications">
        <div class="topnav-dropdown-header">
          <span class="notification-title">Notifications</span>
          <a href="javascript:void(0)" class="clear-noti"> Clear All</a>
        </div>
        <div class="noti-content">
          <ul class="notification-list">
            <li class="notification-message">
              <a href="activities.html">
                <div class="media">
                  <span class="avatar avatar-sm">
                    <img class="avatar-img rounded-circle" alt="" src="assets/img/profiles/avatar-02.jpg" />
                  </span>
                  <div class="media-body">
                    <p class="noti-details">
                      <span class="noti-title">Brian Johnson</span> paid the
                      invoice <span class="noti-title">#DF65485</span>
                    </p>
                    <p class="noti-time">
                      <span class="notification-time">4 mins ago</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="notification-message">
              <a href="activities.html">
                <div class="media">
                  <span class="avatar avatar-sm">
                    <img class="avatar-img rounded-circle" alt="" src="assets/img/profiles/avatar-03.jpg" />
                  </span>
                  <div class="media-body">
                    <p class="noti-details">
                      <span class="noti-title">Marie Canales</span> has accepted
                      your estimate
                      <span class="noti-title">#GTR458789</span>
                    </p>
                    <p class="noti-time">
                      <span class="notification-time">6 mins ago</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="notification-message">
              <a href="activities.html">
                <div class="media">
                  <div class="avatar avatar-sm">
                    <span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
                  </div>
                  <div class="media-body">
                    <p class="noti-details">
                      <span class="noti-title">New user registered</span>
                    </p>
                    <p class="noti-time">
                      <span class="notification-time">8 mins ago</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="notification-message">
              <a href="activities.html">
                <div class="media">
                  <span class="avatar avatar-sm">
                    <img class="avatar-img rounded-circle" alt="" src="assets/img/profiles/avatar-04.jpg" />
                  </span>
                  <div class="media-body">
                    <p class="noti-details">
                      <span class="noti-title">Barbara Moore</span>
                      declined the invoice
                      <span class="noti-title">#RDW026896</span>
                    </p>
                    <p class="noti-time">
                      <span class="notification-time">12 mins ago</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="notification-message">
              <a href="activities.html">
                <div class="media">
                  <div class="avatar avatar-sm">
                    <span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
                  </div>
                  <div class="media-body">
                    <p class="noti-details">
                      <span class="noti-title">You have received a new message</span>
                    </p>
                    <p class="noti-time">
                      <span class="notification-time">2 days ago</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
        <div class="topnav-dropdown-footer">
          <a href="activities.html">View all Notifications</a>
        </div>
      </div>
    </li>
    <!-- /Notifications -->

    <!-- User Menu -->
    <li class="nav-item dropdown has-arrow main-drop">
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <span class="user-img">
          <img src="assets/img/profiles/avatar-01.jpg" alt="" />
          <span class="status online"></span>
        </span>
        <span><?php echo $displayname; ?></span>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-user mr-1">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          Profile</a>
        <a class="dropdown-item" href="settings.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-settings mr-1">
            <circle cx="12" cy="12" r="3"></circle>
            <path
              d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
            </path>
          </svg>
          Settings</a>
        <a class="dropdown-item" href="?logout"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-log-out mr-1">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
          Logout</a>
      </div>
    </li>
    <!-- /User Menu -->
  </ul>
  <!-- /Header Menu -->
</div>