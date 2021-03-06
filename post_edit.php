<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php confirm_login(); ?>
<?php
  $search_query_parameter = $_GET['id'];
  if(isset($_POST["Submit"])){
    $post_title       = $_POST["post_title"];
    $category         = $_POST["category"];
    $image            = $_FILES["image_upload"]["name"];
    $target           =  "uploads/".basename($_FILES["image_upload"]["name"]);
    $post_description = $_POST["post_description"];
    $admin            = "Admin";

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y %B %d - %H:%M:%S",$current_time);

      if(empty($post_title)){
        $_SESSION["ErrorMessage"] = "Title is empty!";
        Redirect_to("admin_private.php?a=posts");
      }elseif (strlen($post_title)<5) {
        $_SESSION["ErrorMessage"] = "Post title should be 2 characters at least!";
        Redirect_to("admin_private.php?a=posts");
      }elseif (strlen($post_description)>9999) {
        $_SESSION["ErrorMessage"] = "The text is too long!";
        Redirect_to("admin_private.php?a=posts");
      }else{
        // Query to update post in DB when everything is fine
        global $connecting_db;
        if (!empty($_FILES["image_upload"]["name"])) {
          $sql = "UPDATE posts
                  SET title='$post_title', category_id='$category', image='$image', post='$post_description'
                  WHERE id='$search_query_parameter'";
        }else{
          $sql = "UPDATE posts
                  SET title='$post_title', category_id='$category', post='$post_description'
                  WHERE id='$search_query_parameter'";
        }

        $execute = $connecting_db->query($sql);

        // Moving the uploaded image to the 'uploads' directory
        move_uploaded_file($_FILES["image_upload"]["tmp_name"],$target);

        // var_dump($execute);
        if($execute){
          $_SESSION["SuccessMessage"]="Post updated successfully!";
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
        }
        Redirect_to("admin_private.php?a=posts");
      }
    } // Ending of Submit button if-condition
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>Edit post</title>
</head>
<body style="background: transparent;">

  <!-- Main part -->
  <div class="">
    <?php
      global $connecting_db;
      $sql = "SELECT p.*, c.title as category_title FROM posts p left join category c on (c.id=p.category_id) WHERE p.id='$search_query_parameter'";
      $stmt = $connecting_db->query($sql);
      while($data_rows = $stmt->fetch()){
        $title_to_be_updated    = $data_rows['title'];
        $category_id            = $data_rows['category_id'];
        $category_to_be_updated = $data_rows['category_title'];
        $image_to_be_updated    = $data_rows['image'];
        $post_to_be_updated     = $data_rows['post'];
      }
    ?>
    <form class="" action="post_edit.php?id=<?php echo $search_query_parameter; ?>" method="post" enctype="multipart/form-data" target="_top">
      <div class="card-body">

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="title" class="m-0"><span class="fieldInfo">Post title:</span></label>
              <input class="form-control" type="text" name="post_title" id="title" placeholder="Type title here" value="<?php echo $title_to_be_updated; ?>">
            </div>

            <div class="form-group">
              <label for="category_title" class="m-0"><span class="fieldInfo">Chose category:</span></label>
              <span class="fieldInfo_2 text-muted float-right pt-1">(Currently the <?php echo "<b class=\"font-weight-bold text-success\">".$category_to_be_updated."</b>"." is set up)"; ?></b></span>
              <select id="category_title" class="form-control pointer" name="category">
                <?php
                // Fetching all the categories from category table
                global $connecting_db;
                $sql = "SELECT id,title FROM category";
                $stmt = $connecting_db->query($sql);
                while($data_rows = $stmt->fetch()){
                  $id = $data_rows["id"];
                  $category_name = $data_rows["title"];
                  $id == $category_id ? $sel = 'SELECTED' : $sel = '';
                  echo '<option '.$sel.' value="'.$id.'">'.$category_name.'</option>';
                }
                ?>
              </select>
            </div>

          </div>
          <div class="col-lg-6">
            <div class="custom-file-container" data-upload-id="myFirstImage">
              <label class="m-0">Select image:
                <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"><span class="fieldInfo_2 text-success clear"><i class="fas fa-times-circle"></i> Clear</span></a>
              </label>
              <span class="fieldInfo_2 text-muted float-right pt-1">(Currently the <?php echo "<b class=\"font-weight-bold text-success\">".basename($image_to_be_updated)."</b>"." image is set up)"; ?></span>
              <label class="custom-file-container__custom-file m-0" for="image_select">
                <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="*" aria-label="Choose File" name="image_upload" id="image_select" value="">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
              </label>
              <div class="pre_view">
                <div class="custom-file-container__image-preview my-3"></div>
                <span class="pre_overlay">
                  <div class="pre_text"><?php echo $image_to_be_updated; ?></div>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="post" class="m-0"><span class="fieldInfo">Post:</span></label>
          <textarea class="form-control" id="post" name="post_description" rows="8" cols="80"><?php echo $post_to_be_updated; ?></textarea>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
              <span class="align-sub"><i class="fas fa-check"></i> Publish</span>
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
  <script type="text/javascript">
    var imgUp = "uploads/<?php echo $image_to_be_updated; ?>";
    var upload = new FileUploadWithPreview('myFirstImage', {showDeleteButtonOnImages: false, text: {chooseFile: 'Select image', browse: 'Browse'}})
  </script>

</body>
</html>
