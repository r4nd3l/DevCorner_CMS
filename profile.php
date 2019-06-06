<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  // Fetching existing data
  $search_query_parameter = $_GET["username"];

  global $connecting_db;
  $sql = "SELECT admin_name,admin_headline,admin_bio,admin_image FROM admins WHERE username=:username";
  $stmt = $connecting_db->prepare($sql);
  $stmt->bindValue(':username', $search_query_parameter);
  $stmt->execute();
  $result = $stmt->rowcount();

  if ($result == 1) {
    while ($data_rows = $stmt->fetch()) {
      $existing_name     = $data_rows["admin_name"];
      $existing_bio      = $data_rows["admin_bio"];
      $existing_image    = $data_rows["admin_image"];
      $existing_headline = $data_rows["admin_headline"];
    }
  }else{
    $_SESSION["ErrorMessage"]="Bad request!";
    Redirect_to("blog.php?page=1");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- DevCorner - Favicon -->
  <link rel="shortcut icon" href="img/favicon.svg"/>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico"/>

  <!-- Font-Awesome v5.8.2 -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

  <!-- Bootstrap 4.3 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Custom Style -->
  <link rel="stylesheet" href="css/styles.css">

  <title>User profile</title>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">

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
          <!-- <li class="nav-item"><a href="my_profile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a></li> -->
          <li class="nav-item"><a href="blog.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="" class="nav-link">About us</a></li>
          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="" class="nav-link">Contact us</a></li>
          <li class="nav-item"><a href="" class="nav-link">Features</a></li>
          <!-- <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Live Blog</a></li> -->
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
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fas fa-user text-success mr-2"></i> <?php echo $existing_name; ?></h1>
          <h3><?php echo $existing_headline; ?></h3>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-md-3">
          <img src="img/<?php echo $existing_image; ?>" class="d-block img-fluid mb-3 rounded-circle border border-success" alt="<?php echo $existing_image; ?>">
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
              <p class="lead"><?php echo $existing_bio; ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Main part - END -->

  <!-- Footer part --><!-- fixed-bottom -->
  <footer class="bg-light border-top">
    <div class="container">
      <div class="row m-3">
        <div class="col">
          <p class="lead text-center">Theme by DevCorner - <span id="year"></span></p>
          <p class="text-center small">
            This site is only used for a case-study of <br>
            <a href="https://github.com/r4nd3l"><i class="fas fa-code text-success" style="cursor: pointer; text-decoration: none;"></i> DevCorner Community</a> -
            The independent web developer community
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer part - END -->


  <!-- CDNs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- Custom scripts -->
  <script type="text/javascript">$('#year').text(new Date().getFullYear());</script>

</body>
</html>
