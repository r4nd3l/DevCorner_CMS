<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php confirm_login(); ?>
<?php
  $search_query_parameter = $_GET['id'];

  // Fetching existing content according to our post
  global $connecting_db;
  $sql = "SELECT * FROM posts WHERE id='$search_query_parameter'";
  $stmt = $connecting_db->query($sql);
  while($data_rows = $stmt->fetch()){
    $title_to_be_deleted    = $data_rows['title'];
    $category_to_be_deleted = $data_rows['category'];
    $image_to_be_deleted    = $data_rows['image'];
    $post_to_be_deleted     = $data_rows['post'];
  }
  // echo $image_to_be_deleted;
  if(isset($_POST["Submit"])){
    // Query to delete post in DB when everything is fine
    global $connecting_db;
    $sql = "DELETE FROM posts WHERE id='$search_query_parameter'";
    $execute = $connecting_db->query($sql);

    // var_dump($execute);
    if($execute){
      $target_path_to_delete_image = "uploads/$image_to_be_deleted";
      unlink($target_path_to_delete_image);
      $_SESSION["SuccessMessage"]="Post deleted successfully!";
      Redirect_to("posts.php");
    }else{
      $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
      Redirect_to("posts.php");
    }
  } // Ending of Submit button if-condition
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
  <!-- Custom Style -->
<link rel="stylesheet" href="css/styles.css" type="text/css">

<!-- Google Fonts Roboto - Fallback -->
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 

  <title>Delete post</title>
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
          <h6><i class="fas fa-edit text-success"></i> Delete post</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();


        ?>
        <form class="" action="delete_post.php?id=<?php echo $search_query_parameter; ?>" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new post</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Post title:</span></label>
                <input disabled class="form-control" type="text" name="post_title" id="title" placeholder="Type title here" value="<?php echo $title_to_be_deleted; ?>">
              </div>
              <div class="form-group">
                <span class="fieldInfo_2">(Currently the <?php echo "<b>".$category_to_be_deleted."</b>"." is set up)"; ?></span>

              </div>
              <div class="form-group">
                <span class="fieldInfo_2">(Currently the <?php echo "<b>".basename($image_to_be_deleted)."</b>"." image is set up)"; ?></span>
                <!-- Modal will goes here -->
                <img src="uploads/<?php echo $image_to_be_deleted; ?>" width="170px">

              </div>
              <div class="form-group">
                <label for="post"><span class="fieldInfo">Post:</span></label>
                <textarea disabled class="form-control" id="post" name="post_description" rows="8" cols="80"><?php echo $post_to_be_deleted; ?></textarea>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="dashboard.php" class="btn btn-light btn-sm border">
                    <span class="align-sub"><i class="fas fa-arrow-left"></i> Back to dashboard</span>
                  </a>
                  <button type="submit" name="Submit" class="btn btn-danger btn-sm float-right">
                    <span class="align-sub"><i class="fas fa-trash"></i> Delete</span>
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
