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
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>User profile</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/navbar_public.php"); ?>
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
    <?php require_once("partials/footer.php"); ?>
  <!-- Footer part - END -->

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
