<div class="header">
  <!-- Logo -->
  <div class="header-left">
    <a href="<?= ADMIN_URL ?>/dashboard" class="logo">
      <img src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png" alt="Logo" />
    </a>
    <a href="<?= ADMIN_URL ?>/dashboard" class="logo logo-small">
      <img src="https://auteur.g5plus.net/wp-content/uploads/2019/01/logo-black.png" alt="Logo" width="30" height="30" />
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
    <!-- User Menu -->
    <li class="nav-item dropdown has-arrow main-drop">
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <span class="user-img">
          <img src="assets/img/profiles/avatar-01.jpg" alt="" />
          <span class="status online"></span>
        </span>
        <span><?= $_SESSION["user"]["username"]; ?></span>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= ADMIN_URL ?>/user/edit/<?= $_SESSION["user"]["id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="feather feather-user mr-1">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
          Profile</a>
        <a class="dropdown-item" href="<?= SITE_URL ?>/account/userlogout"><svg xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out mr-1">
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