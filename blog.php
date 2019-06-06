<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
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

  <title>Blog</title>
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
          <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="" class="nav-link">About us</a></li>
          <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Blog</a></li>
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
          }elseif (isset($_GET["page"])) {
            // Query when pagination is active ex blog.php?page=1
            $page = $_GET["page"];
            // zero (0) should not be present in the URL lik this -> blog.php?page=0
            if ($page == 0 || $page<1) {
              $show_post_from = 0;
            }else{
              $show_post_from = ($page*5)-5;
            }
            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $show_post_from,5";
            $stmt = $connecting_db->query($sql);
          }elseif (isset($_GET["category"])) {
            // Query when category is active in URL tab
            $category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category=:category_name";
            $stmt = $connecting_db->prepare($sql);
            $stmt->bindValue(':category_name',$category);
            $stmt->execute();
          }


          // The default SQL query
          else{
            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
            $stmt = $connecting_db->query($sql);
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
        <div class="card mb-3">
          <a href="full_post.php?id=<?php echo $postId; ?>">
            <img src="uploads/<?php echo htmlentities($image); ?>" class="img-fluid card-img-top" title="<?php echo htmlentities($post_title); ?>" alt="<?php echo htmlentities($image); ?>">
          </a>
          <div class="card-body">
            <a href="full_post.php?id=<?php echo $postId; ?>"><h4 class="bard-title mb-0"><?php echo htmlentities($post_title); ?></h4></a>
            <small class="text-muted"><i class="fas fa-tag fa-flip-horizontal text-success"></i> <a href="blog.php?category=<?php echo htmlentities($category); ?>"><?php echo htmlentities($category); ?></a></small><br>
            <small class="text-muted">Written by <a href="profile.php?username=<?php echo htmlentities($admin); ?>" class="text-success"><?php echo htmlentities($admin); ?></a> On <?php echo htmlentities($datetime); ?></small>
            <span class="float-right fieldInfo_2"><i class="fas fa-comment-alt text-success"></i> <?php approve_comment($postId);?> Comment</span>
            <hr>
            <p class="card-text">
              <?php
                if(strlen($post_description)>150){
                  $post_description = substr($post_description,0,150)."...";
                }
                echo htmlentities($post_description);
              ?>
            </p>
            <a href="full_post.php?id=<?php echo $postId; ?>" class="btn btn-success btn-sm float-right">
              <span class="align-sub"><i class="fas fa-chevron-right"></i> Read more</span>
            </a>
          </div>
        </div>
        <?php } ?>

        <!-- Pagination -->
        <nav>
          <ul class="pagination pagination-md">
            <!-- Creating backward button -->
            <?php
              if(isset($page)){
                if ($page > 1) {
                ?>
                  <li class="page-item ">
                    <a href="blog.php?page=<?php echo $page-1; ?>" class="page-link text-success"><i class="fas fa-chevron-left"></i></a>
                  </li>
                <?php
                }
              }
            ?>

            <?php
              global $connecting_db;
              $sql = "SELECT COUNT(*) FROM posts";
              $stmt = $connecting_db->query($sql);
              $row_pagination = $stmt->fetch();
              $total_posts = array_shift($row_pagination);
              // echo $total_posts."<br>";
              $post_pagination = $total_posts/5;
              $post_pagination = ceil($post_pagination);
              // echo $post_pagination;

              // A loop for pagination
              for ($i=1; $i <=$post_pagination; $i++) {
                if (isset($page)) {
                  if ($i == $page) {
                    ?>
                      <li class="page-item active">
                        <a href="blog.php?page=<?php echo $i; ?>" class="page-link bg-success border-success"><?php echo $i; ?></a>
                      </li>
                    <?php
                    }else{
                    ?>
                      <li class="page-item ">
                        <a href="blog.php?page=<?php echo $i; ?>" class="page-link text-success"><?php echo $i; ?></a>
                      </li>
                    <?php
                  }
                }
              }
            ?>
            <!-- Creating forward button -->
            <?php
              if(isset($page) && !empty($page)){
                if ($page + 1 <= $post_pagination) {
                ?>
                  <li class="page-item ">
                    <a href="blog.php?page=<?php echo $page+1; ?>" class="page-link text-success"><i class="fas fa-chevron-right"></i></a>
                  </li>
                <?php
                }
              }
            ?>
          </ul>
        </nav>

      </div>

      <!-- Side area -->
      <div class="col-sm-4">
        <?php require_once("right_sidebar.php"); ?>
      </div>
      <!-- Side area - END -->
    </div>
  </div>
  <!-- Header - END -->

  <!-- Main part -->

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
