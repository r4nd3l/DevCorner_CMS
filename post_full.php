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
    $datetime     = strftime("%Y.%m.%d - %H:%M:%S",$current_time);
    // $datetime     = strftime("%Y %b %d - %H:%M:%S",$current_time);

      if(empty($name) || empty($email) || empty($comment)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out!";
        Redirect_to("post_full.php?id={$search_query_parameter}");
      }elseif (strlen($category)>500) {
        $_SESSION["ErrorMessage"] = "Comment length should shorter! (maximum is 500 character)";
        Redirect_to("post_full.php?id={$search_query_parameter}");
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
          Redirect_to("post_full.php?id={$search_query_parameter}");
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
          Redirect_to("post_full.php?id={$search_query_parameter}");
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

  <title>Full post</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/navbar_public.php"); ?>
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
            $category          = $data_rows["category_title"];
            $admin             = $data_rows["author"];
            $image             = $data_rows["image"];
            $post_description  = $data_rows["post"];
        ?>
        <div class="card mb-5">
          <img src="uploads/<?php echo htmlentities($image); ?>" class="img-fluid card-img-top" title="<?php echo $image; ?>" alt="<?php echo $image; ?>">
          <div class="card-body">
            <h4 class="bard-title mb-0"><?php echo htmlentities($post_title); ?></h4>
            <small class="text-muted"><i class="fas fa-tag fa-flip-horizontal text-success"></i> <a href=blog.php?category=<?php echo htmlentities($category); ?>"><?php echo htmlentities($category); ?></a></small><br>
            <small class="text-muted">Written by <a href="profile_public.php?username=<?php echo htmlentities($admin); ?>" class="text-success"><?php echo htmlentities($admin); ?></a><br>
            On <?php echo htmlentities($datetime); ?></small>
            <span class="float-right fieldInfo_2 mt-1"><i class="fas fa-comment-alt text-success"></i> <?php echo  comment_approve($postId);?> <a href="#sec_comment" class="scroll_to_section">Comment</a></span>
            <hr>
            <p class="card-text">
              <?php echo nl2br($post_description); ?></p>
          </div>
        </div>
        <?php } ?>

        <!-- Comment part -->
        <div class="mb-5">
          <h3 id="sec_comment" class="text-dark"><i class="fas fa-comment-alt text-success"></i> Comments</h3>
            <!-- Fetching existing comment -->
            <?php
              global $connecting_db;
              $sql = "SELECT *FROM comments WHERE post_id='$search_query_parameter' AND status=1";
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
          <form class="" action="post_full.php?id=<?php echo $search_query_parameter; ?>" method="post">
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
        <?php require_once("partials/sidebar_right.php"); ?>
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

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
