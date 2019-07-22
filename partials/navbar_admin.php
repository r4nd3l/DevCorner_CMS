<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top shadow-sm">

  <!-- Logo part -->
  <!-- <a href="" class="navbar-brand"><i class="fas fa-code text-success"></i> DevCorner</a> -->

  <!-- Current section's title -->
  <p class="m-0" style="width: 200px;">Current section's title</p>

  <div class="container-fluid">

    <!-- The button for "Collapsable munu" -->
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_CMS">
      <span class="navbar-toggler-icon text-white"></span>
    </button>

    <!-- Collapsable menu -->
    <div class="collapse navbar-collapse" id="navbar_collapse_CMS">
      <!-- Menu part -->
      <ul class="navbar-nav m-auto">
        <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Sample link</a></li>
      </ul>

      <!-- Login/out part -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <div class="btn-group btn-group-sm border-secondary" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-light border border-secondary">
              <a href="" class="text-success"><span class="align-sub"><i class="fas fa-home "></i> Home</span></a>
            </button>
            <button type="button" class="btn btn-light border border-secondary">
              <a href="logout.php" class="text-secondary"><span class="align-sub"><i class="fas fa-power-off "></i> Logout</span></a>
            </button>
          </div>
        </li>
      </ul>
    </div>

  </div>
</nav>
