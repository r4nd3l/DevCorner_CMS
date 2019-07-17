<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top shadow-sm">

  <!-- Sidebar toggle -->
  <a href="javascript:void(0)">
    <i class="fab fa-elementor fa-2x text-success" onclick="openSideBar()"></i>
  </a>

  <div class="container-fluid">

    <!-- Logo part -->
    <!-- <a href="" class="navbar-brand"><i class="fas fa-code text-success"></i> DevCorner</a> -->

    <!-- The button for "Collapsable munu" -->
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_CMS">
      <span class="navbar-toggler-icon text-white"></span>
    </button>

    <!-- Collapsable menu -->
    <div class="collapse navbar-collapse" id="navbar_collapse_CMS">
      <!-- Menu part -->
      <ul class="navbar-nav m-auto">
        <li class="nav-item"><a href="admin_private.php?a=dashboard" class="nav-link"> Dashboard</a></li>
        <li class="nav-item"><a href="admin_private.php?a=profile_private" class="nav-link"> Profile</a></li>
        <li class="nav-item"><a href="admin_private.php?a=indicators" class="nav-link">Indicators</a></li>
        <li class="nav-item"><a href="admin_private.php?a=posts" class="nav-link">Posts</a></li>
        <li class="nav-item"><a href="admin_private.php?a=categories" class="nav-link">Categories</a></li>
        <li class="nav-item"><a href="admin_private.php?a=admins" class="nav-link">Admins</a></li>
        <li class="nav-item"><a href="admin_private.php?a=comments" class="nav-link">Comments</a></li>
        <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Blog</a></li>
      </ul>

      <!-- Login/out part -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="logout.php" class="btn btn-light btn-sm nav-link">
            <span class="align-sub"><i class="fas fa-sign-out-alt"></i> Logout</span>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>
