<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
  <div class="container-fluid">

    <!-- Logo part -->
    <a href="" class="navbar-brand"><i class="fas fa-code text-success"></i> DevCorner</a>

    <!-- The button for "Collapsable munu" -->
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_CMS">
      <span class="navbar-toggler-icon text-white"></span>
    </button>

    <!-- Collapsable menu -->
    <div class="collapse navbar-collapse" id="navbar_collapse_CMS">
      <!-- Menu part -->
      <ul class="navbar-nav m-auto">
        <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="" class="nav-link">About us</a></li>
        <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="" class="nav-link">Contact us</a></li>
        <li class="nav-item"><a href="" class="nav-link">Features</a></li>
      </ul>

      <!-- Login/out part -->
      <ul class="navbar-nav">
        <form class="" action="blog.php">
          <div class="input-group">
            <input type="text" class="form-control" name="Search" placeholder="Search here" aria-label="Search here" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="input-group-text" id="basic-addon2" name="search_button">
                <span class="align-sub"><i class="fas fa-search"></i> Search</span>
              </button>
            </div>
          </div>
        </form>
      </ul>
    </div>

  </div>
</nav>
