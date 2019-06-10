<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<?php
  if(isset($_POST["Submit"])){
    $post_title       = $_POST["post_title"];
    $category         = $_POST["category"];
    $image            = $_FILES["image_upload"]["name"];
    $target           =  "uploads/".basename($_FILES["image_upload"]["name"]);
    $post_description = $_POST["post_description"];
    $admin            = $_SESSION["userName"];

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y %B %d - %H:%M:%S",$current_time);

      if(empty($post_title)){
        $_SESSION["ErrorMessage"] = "Title is empty!";
        Redirect_to("add_new_post.php");
      }elseif (strlen($post_title)<5) {
        $_SESSION["ErrorMessage"] = "Post title should be greater than 2 characters!";
        Redirect_to("add_new_post.php");
      }elseif (strlen($post_description)>9999) {
        $_SESSION["ErrorMessage"] = "The text is too long!";
        Redirect_to("add_new_post.php");
      }else{
        // Query to insert post in DB when everything is fine
        global $connecting_db;
        $sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
        $sql .= "VALUES(:dateTime,:postTitle,:categoryName,:adminName,:imageName,:postDescription)";
        $stmt = $connecting_db->prepare($sql);
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':postTitle',$post_title);
        $stmt->bindValue(':categoryName',$category);
        $stmt->bindValue(':adminName',$admin);
        $stmt->bindValue(':imageName',$image);
        $stmt->bindValue(':postDescription',$post_description);
        $execute = $stmt->execute();

        // Moving the uploaded image to the 'uploads' directory
        move_uploaded_file($_FILES["image_upload"]["tmp_name"],$target);

        if($execute){
          $_SESSION["SuccessMessage"]="Post with id: ". $connecting_db->lastInsertId() ." added successfully!";
          Redirect_to("add_new_post.php");
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
          Redirect_to("add_new_post.php");
        }
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
  <link rel="stylesheet" href="css/styles.css">

  <title>Add new post</title>
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
          <h6><i class="fas fa-edit text-success"></i> Manage post</h6>
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
        <form class="" action="add_new_post.php" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new post</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Post title:</span></label>
                <input class="form-control" type="text" name="post_title" id="title" placeholder="Type title here" value="">
              </div>
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Chose category:</span></label>
                <select id="category_title" class="form-control" name="category">
                  <?php
                    // Fetching all the categories from category table
                    global $connecting_db;
                    $sql = "SELECT id,title FROM category";
                    $stmt = $connecting_db->query($sql);
                    while($data_rows = $stmt->fetch()){
                      $id = $data_rows["id"];
                      $category_name = $data_rows["title"];
                  ?>
                    <option><?php echo $category_name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="image_upload" id="image_select" value="">
                  <label for="image_select" class="custom-file-label">Select image</label>
                </div>
              </div>
              <div class="form-group">
                <label for="post"><span class="fieldInfo">Post:</span></label>
                <textarea class="form-control" id="post" name="post_description" rows="8" cols="80"></textarea>
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