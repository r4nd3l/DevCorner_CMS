<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $search_query_parameter = $_GET["id"]; ?>
<?php
  if(isset($_POST["Submit"])){
    $name = $_POST["commenter_name"];
    $email = $_POST["commenter_email"];
    $comment = $_POST["commenter_thoughts"];

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y %B %d - %H:%M:%S",$current_time);

      if(empty($name) || empty($email) || empty($comment)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out!";
        Redirect_to("full_post.php?id={$search_query_parameter}");
      }elseif (strlen($category)>500) {
        $_SESSION["ErrorMessage"] = "Comment length should shorter! (maximum is 500 character)";
        Redirect_to("full_post.php?id={$search_query_parameter}");
      }else{
        // Query to insert comment in DB when everything is fine
        global $connecting_db;
        $sql = "INSERT INTO comments(datetime,name,email,comment,approved_by,status,post_id)";
        $sql .= "VALUES(:dateTime,:name,:email,:comment,'Pending','OFF',:post_id_from_URL)";
        $stmt = $connecting_db->prepare($sql);
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':name',$name);
        $stmt->bindValue(':email',$email);
        $stmt->bindValue(':comment',$comment);
        $stmt->bindValue(':post_id_from_URL',$search_query_parameter);
        $execute = $stmt->execute();

        // var_dump($Execute);
        if($execute){
          $_SESSION["SuccessMessage"]="Comment submitted successfully! (under approval process)";
          Redirect_to("full_post.php?id={$search_query_parameter}");
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
          Redirect_to("full_post.php?id={$search_query_parameter}");
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
  <link rel="stylesheet" href="css/styles.css" type="text/css">

  <!-- Google Fonts Roboto - Fallback -->
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <title>Full post</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/public_navbar.php"); ?>
  <!-- Navbar - END -->

  <!-- Header -->
  <div class="container">
    <div class="row mt-4">

      <!-- Main area -->
      <div class="col-sm-8">
        <h1><i class="fas fa-code text-success"></i> DevCorner Community CMS</h1>
        <h1 class="lead">The independent web developer community</h1>
        <hr>
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <?php
          global $connecting_db;
          // SQL query when search button is active
          if (isset($_GET["search_button"])) {
            $search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";

            $stmt = $connecting_db->prepare($sql);
            $stmt->bindValue(':search','%'.$search.'%');
            $stmt->execute();
          }
          // The default SQL query
          else{
            $postIdFromURL = $_GET["id"];
            if (!isset($postIdFromURL)) {
              $_SESSION["ErrorMessage"]="Bad Request!";
              Redirect_to("blog.php");
            }
            $sql = "SELECT * FROM posts WHERE id='$postIdFromURL'";
            $stmt = $connecting_db->query($sql);
            $result = $stmt->rowcount();

            if ($result !=1) {
              $_SESSION["ErrorMessage"]="Bad Request!";
              Redirect_to("blog.php?page=1");
            }
          }
          while($data_rows = $stmt->fetch()){
            $postId            = $data_rows["id"];
            $datetime          = $data_rows["datetime"];
            $post_title        = $data_rows["title"];
            $category          = $data_rows["category"];
            $admin             = $data_rows["author"];
            $image             = $data_rows["image"];
            $post_description  = $data_rows["post"];
        ?>
        <div class="card mb-5">
          <img src="uploads/<?php echo htmlentities($image); ?>" class="img-fluid card-img-top" title="<?php echo $image; ?>" alt="<?php echo $image; ?>">
          <div class="card-body">
            <h4 class="bard-title mb-0"><?php echo htmlentities($post_title); ?></h4>
            <small class="text-muted"><i class="fas fa-tag fa-flip-horizontal text-success"></i> <a href="blog.php?category=<?php echo htmlentities($category); ?>"><?php echo htmlentities($category); ?></a></small><br>
            <small class="text-muted">Written by <a href="profile.php?username=<?php echo htmlentities($admin); ?>" class="text-success"><?php echo htmlentities($admin); ?></a><br>
            On <?php echo htmlentities($datetime); ?></small>
            <span class="float-right fieldInfo_2 mt-1"><i class="fas fa-comment-alt text-success"></i> <?php approve_comment($postId);?> Comment</span>
            <hr>
            <p class="card-text">
              <?php echo nl2br($post_description); ?></p>
          </div>
        </div>
        <?php } ?>

        <!-- Comment part -->
        <div class="mb-5">
          <h3 class="text-dark"><i class="fas fa-comment-alt text-success"></i> Comments</h3>
            <!-- Fetching existing comment -->
            <?php
              global $connecting_db;
              $sql = "SELECT *FROM comments WHERE post_id='$search_query_parameter' AND status='ON'";
              $stmt = $connecting_db->query($sql);
              while($data_rows = $stmt->fetch()){
                $comment_date = $data_rows['datetime'];
                $comment_name = $data_rows['name'];
                $comment_content = $data_rows['comment'];
            ?>
          <div class="">
            <div class="media bg-grayish py-2 rounded mb-2 rounded border">
              <div class="media-body mx-2">
                <img src="img/blank.png" class="img-profile img-fluid rounded float-left mr-2" alt="profile picture">
                <div class="">
                  <h6 class="lead font-weight-bold m-0"><?php echo $comment_name; ?></h6>
                  <small class="fieldInfo_2 text-muted"> at <?php echo $comment_date; ?></small>
                </div>
                <hr class="my-1">
                <p class="mt-2 mb-0"><?php echo $comment_content; ?></p>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- Fetching existing comment - END -->
        </div>
        <!-- Comment part - END -->


        <div class="">
          <form class="" action="full_post.php?id=<?php echo $search_query_parameter; ?>" method="post">
            <div class="card mb-3">
              <div class="card-header">
                <h5 class="fieldInfo m-0">Share your thoughts about this post</h5>
              </div>
              <div class="card-body">

                <!-- Name to fill part -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input class="form-control" type="text" name="commenter_name" placeholder="Name">
                  </div>
                </div>

                <!--Email to fill part  -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    </div>
                    <input class="form-control" type="email" name="commenter_email" placeholder="Email">
                  </div>
                </div>

                <!-- Thoughts to fill part -->
                <div class="form-group">
                  <textarea class="form-control" name="commenter_thoughts" rows="6" cols="80"></textarea>
                </div>

                <div class="">
                  <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
                    <span class="align-sub"><i class="fas fa-reply"></i> Submit</span>
                  </button>
                </div>

              </div>
            </div>
          </form>
        </div>
        <!-- Comment part - END -->
      </div>

      <!-- Side area -->
      <div class="col-sm-4">
        <div class="card mt-4">
          <div class="card-body">
            <img src="img/img_05.jpeg" class="d-block img-fluid mb-3" alt="side_banner">
            <div class="text-justify">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati soluta quidem quis error voluptatem, voluptatibus ratione ducimus officia, ipsa, iste velit ut in eius? Vitae quibusdam magni quos sint eius.
            </div>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header bg-dark text-light">
            <h2 class="lead">Sign up!</h2>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the forum</button>
            <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="" placeholder="Enter your email">
              <div class="input-group-append">
                <button class="btn btn-primary btn-sm text-center text-white">Subscribe now!</button>
              </div>
            </div>
          </div>
        </div>
        <br>

        <div class="card">
          <div class="card-header bg-primary text-light">
            <h2 class="lead">Categories</h2>
          </div>
          <div class="card-body">
            <?php
            global $connecting_db;
            $sql = "SELECT * FROM category ORDER BY id desc";
            $stmt = $connecting_db->query($sql);

            while ($data_rows = $stmt->fetch()) {
              $category_id = $data_rows["id"];
              $category_name = $data_rows["title"];
              ?>
              <a href="blog.php?category=<?php echo $category_name; ?>"><span class="heading"><?php echo $category_name; ?></span></a><br>
            <?php } ?>
          </div>
        </div>
        <br>

        <div class="card">
          <div class="card-header bg-info text-white">
            <h2 class="lead">Recent posts</h2>
          </div>
          <div class="card-body">
            <?php
              global $connecting_db;
              $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt = $connecting_db->query($sql);

              while ($data_rows = $stmt->fetch()) {
                $id       = $data_rows['id'];
                $title    = $data_rows['title'];
                $datetime = $data_rows['datetime'];
                $image    = $data_rows['image'];
            ?>
              <div class="media">
                <img src="uploads/<?php echo htmlentities($image); ?>" class="d-block img-fluid align-self-start" width="90" height="90" alt="<?php echo htmlentities($image); ?>" title="<?php echo htmlentities($image); ?>">
                <div class="media-body ml-2">
                  <a href="full_post.php?id=<?php echo htmlentities($id); ?>" target="_blank">
                    <h6 class="lead"><?php echo htmlentities($title); ?></h6>
                  </a>
                  <p class="small"><?php echo htmlentities($datetime); ?></p>
                </div>
              </div>
              <hr>
            <?php } ?>
          </div>
        </div>

      </div>
      <!-- Side area - END -->
    </div>
  </div>
  <!-- Header - END -->

  <!-- Main part -->

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
