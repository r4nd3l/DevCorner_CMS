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
        <li class="nav-item ml-2">
          <div class="btn-group btn-group-sm border-secondary" role="group" aria-label="nav-items">
            <!-- Home button -->
            <button type="button" class="btn btn-light border">
              <a href="admin_private.php?a=dashboard" class="text-success"><span class="align-sub"><i class="fas fa-home "></i></span></a>
            </button>
            <!-- Home button - END -->

            <!-- settings button -->
            <div class="btn-group dropdown">
              <button class="btn btn-light border border-secondary rounded-right btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a href="" class="text-success"><span class="align-sub"><i class="fas fa-cog"></i></span></a>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item text-secondary" href="#"><i class="fas fa-cogs fa-fw text-success mr-1"></i> <span>Settings</span></a>
                <a class="dropdown-item text-secondary" href="#"><i class="fas fa-language fa-fw text-success mr-1"></i> <span>Language: English (UK)</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-secondary" href="#"><i class="far fa-question-circle fa-fw text-success mr-1"></i> <span>Help</span></a>
                <a class="dropdown-item text-secondary" href="#"><i class="far fa-comment-alt fa-fw text-success mr-1"></i> <span>Send feedback</span></a>
                <a class="dropdown-item text-secondary" href="#"><i class="fas fa-adjust fa-fw text-success mr-1"></i> <span>Dark theme</span>
                  <label class="switch float-right">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                </a>
                <a class="dropdown-item text-secondary" href="logout.php"><i class="fas fa-power-off fa-fw text-success mr-1"></i> <span>Logout</span></a>
              </div>
            </div>
            <!-- settings button - END -->

          </div>
        </li>

      </ul>
    </div>

  </div>
</nav>
