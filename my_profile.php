<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<?php
  // Fetching the existing admin data start
  $admin_id = $_SESSION["user_id"];
  global $connecting_db;
  $sql = "SELECT * FROM admins WHERE id='$admin_id'";
  $stmt = $connecting_db->query($sql);

  while ($data_rows = $stmt->fetch()) {
    $existing_name     = $data_rows["admin_name"];
    $existing_username = $data_rows["username"];
    $existing_headline = $data_rows["admin_headline"];
    $existing_bio      = $data_rows["admin_bio"];
    $existing_image    = $data_rows["admin_image"];
  }

  if(isset($_POST["Submit"])){
    $admin_name     = $_POST["admin_name"];
    $admin_headline = $_POST["admin_headline"];
    $admin_bio      = $_POST["admin_bio"];
    $admin_image    = $_FILES["image_upload"]["name"];
    $target         =  "img/".basename($_FILES["image_upload"]["name"]);

    if (strlen($admin_headline)>30) {
      $_SESSION["ErrorMessage"] = "Headline is too long! (maximum is 30 character)";
      Redirect_to("my_profile.php");
    }elseif (strlen($admin_bio)>500) {
      $_SESSION["ErrorMessage"] = "Bio text is too long! (maximum is 500 character)";
      Redirect_to("my_profile.php");
    }else{
      // Query to update admin data in DB when everything is fine
      global $connecting_db;
      if (!empty($_FILES["image_upload"]["name"])) {
        $sql = "UPDATE admins
                SET admin_name='$admin_name', admin_headline='$admin_headline', admin_bio='$admin_bio', admin_image='$admin_image'
                WHERE id='$admin_id'";
      }else{
        $sql = "UPDATE admins
                SET admin_name='$admin_name', admin_headline='$admin_headline', admin_bio='$admin_bio'
                WHERE id='$admin_id'";
      }
      $execute = $connecting_db->query($sql);

      // Moving the uploaded image to the 'uploads' directory
      move_uploaded_file($_FILES["image_upload"]["tmp_name"],$target);

      if($execute){
        $_SESSION["SuccessMessage"]="Details updated successfully!";
        Redirect_to("my_profile.php");
      }else{
        $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
        Redirect_to("my_profile.php");
      }
    }
  } // Ending of Submit button if-condition
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>My profile</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/admin_navbar.php"); ?>
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-user text-success"></i> <?php echo $existing_username; ?></h6>
          <small class="text-success"><?php echo $existing_headline; ?></small>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <!-- Left column -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-dark text-light">
            <h3><?php echo $existing_name; ?></h3>
          </div>
          <div class="card-body">
            <img src="img/<?php echo $existing_image; ?>" class="block img-fluid" alt="<?php echo $existing_image; ?>">
            <div class=""><?php echo $existing_bio; ?></div>
          </div>
        </div>
      </div>
      <!-- Left column - END -->


      <div class="col-lg-9" style="">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <form class="" action="my_profile.php" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Edit profile</h5>
            </div>

            <div class="card-body">
              <div class="form-group">
                <input class="form-control" type="text" name="admin_name" id="my_name" placeholder="Your name" value="">
              </div>

              <div class="form-group">
                <input class="form-control" type="text" id="my_name" placeholder="Headline" name="admin_headline">
                <small class="text-muted">Add a professional headline like, 'Web developer' at DevCorner
                  <span class="text-danger">Not more than 30 characters</span>
                </small>
              </div>

              <div class="form-group">
                <textarea class="form-control" id="post" name="admin_bio" rows="8" cols="80" placeholder="Bio"></textarea>
              </div>

              <div class="form-group">
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="image_upload" id="image_select" value="">
                  <label for="image_select" class="custom-file-label">Select image</label>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <a href="dashboard.php" class="btn btn-light btn-sm border">
                    <span class="align-sub"><i class="fas fa-arrow-left"></i> Back to dashboard</span>
                  </a>
                  <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
                    <span class="align-sub"><i class="fas fa-check"></i> Publish</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Main part - END -->

  <!-- Footer part --><!-- fixed-bottom -->
    <?php require_once("partials/footer.php"); ?>
  <!-- Footer part - END -->


  <!-- CDNs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- Custom scripts -->
  <script type="text/javascript">$('#year').text(new Date().getFullYear());</script>

</body>
</html>
