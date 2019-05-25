<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
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
        Redirect_to("add_new_post.php");
      }elseif (strlen($post_title)<5) {
        $_SESSION["ErrorMessage"] = "Post title should be greater than 2 characters!";
        Redirect_to("add_new_post.php");
      }elseif (strlen($post_description)>999) {
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
          $_SESSION["SuccessMessage"]="Something went wrong.. Please try again!";
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
          <li class="nav-item"><a href="myProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a></li>
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
          <li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
          <li class="nav-item"><a href="admins.php" class="nav-link">Manage Admins</a></li>
          <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
          <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Live Blog</a></li>
        </ul>

        <!-- Login/out part -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="logout.php" class="btn btn-light btn-sm nav-link">
              <span class="align-sub"><i class="fas fa-sign-out-alt"></i> Logout</span>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-edit text-success"></i> Manage post</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container py-2 mb-4">
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

  <!-- Footer part -->
  <footer class="bg-light border-top fixed-bottom">
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
