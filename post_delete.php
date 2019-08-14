<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php confirm_login(); ?>
<?php
  $search_query_parameter = $_GET['id'];

  // Fetching existing content according to our post
  global $connecting_db;
  $sql = "SELECT p.*, c.title as category_title FROM posts p left join category c on (c.id=p.category_id) WHERE p.id='$search_query_parameter'";
  $stmt = $connecting_db->query($sql);
  while($data_rows = $stmt->fetch()){
    $title_to_be_deleted    = $data_rows['title'];
    $category_id            = $data_rows['category_id'];
    $category_to_be_deleted = $data_rows['category_title'];
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
    }else{
      $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
    }
    Redirect_to("admin_private.php?a=dashboard#sec_posts");
  } // Ending of Submit button if-condition
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>Delete post</title>
</head>
<body style="background: transparent;">

  <!-- Main part -->
  <div class="">
    <form class="" action="post_delete.php?id=<?php echo $search_query_parameter; ?>" method="post" enctype="multipart/form-data" target="_top">
      <div class="card-body">

        <div class="row">
          <div class="col-lg-6">

            <div class="form-group">
              <label for="title" class="m-0"><span class="fieldInfo">Post title:</span></label>
              <input disabled class="form-control" type="text" name="post_title" id="title" value="<?php echo $title_to_be_deleted; ?>">
            </div>
            <div class="form-group">
              <label for="category_title" class="m-0"><span class="fieldInfo">Post category:</span></label>
              <input disabled class="form-control" type="text" name="category" id="category_title" value="<?php echo $category_to_be_deleted; ?>">
            </div>

          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="post_image" class="m-0"><span class="fieldInfo">Post image:</span></label>
              <input disabled class="form-control" type="text" name="category" id="post_image" value="<?php echo basename($image_to_be_deleted); ?>">

              <div class="pre_view">
                <img src="uploads/<?php echo $image_to_be_deleted; ?>"  class="img-fluid rounded shadow w-100 mt-3" style="height: 20em;object-fit: cover;">
                <span class="pre_overlay">
                  <div class="pre_text"><?php echo $image_to_be_deleted; ?></div>
                </span>
              </div>

            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="post" class="m-0"><span class="fieldInfo">Post:</span></label>
          <textarea disabled class="form-control" id="post" name="post_description" rows="8" cols="80"><?php echo $post_to_be_deleted; ?></textarea>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <button type="submit" name="Submit" class="btn btn-danger btn-sm float-right">
              <span class="align-sub"><i class="fas fa-trash"></i> Delete</span>
            </button>
          </div>
        </div>

      </div>
    </form>
  </div>
  <!-- Main part - END -->

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
