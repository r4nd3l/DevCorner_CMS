<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>Blog</title>
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


          if(!$_GET['page']) {
            $page = 1;
          } else {
            $page = $_GET["page"];
          }
          $postNum = 5;

          if ($page<=1) {
            $show_post_from = 0;
          }else{
            $show_post_from = ($page*$postNum)-$postNum;
          }

          // SQL query when search button is active
          if (isset($_GET["search_button"])) {
            $search = $_GET["Search"];
            $sql = "SELECT  p.*, c.title FROM posts p
            left join category c on (c.id=p.category_id)
            WHERE p.datetime LIKE :search
            OR p.title LIKE :search
            OR c.title LIKE :search
            OR p.post LIKE :search
            LIMIT $show_post_from,$postNum";

            $stmt = $connecting_db->prepare($sql);
            $stmt->bindValue(':search','%'.$search.'%');
            $stmt->execute();
            //$stmt->debugDumpParams();
          } elseif (isset($_GET["category"])) {
            // Query when category is active in URL tab
            $category = $_GET["category"];
            $sql = "SELECT  p.*, c.title FROM posts p left join category c on (c.id=p.category_id) WHERE c.title like :category_title LIMIT $show_post_from,$postNum";
            $stmt = $connecting_db->prepare($sql);
            $stmt->bindValue(':category_title','%'.$category.'%');
            $stmt->execute();
            //$stmt->debugDumpParams();
          }


          // The default SQL query
          else{
            $sql = "SELECT p.*, c.title as category_title FROM posts p left join category c on (c.id=p.category_id) ORDER BY p.id desc LIMIT $show_post_from,$postNum";
            $stmt = $connecting_db->query($sql);
          }
          while($data_rows = $stmt->fetch()){
            //var_dump($data_rows);
            $postId            = $data_rows["id"];
            $datetime          = $data_rows["datetime"];
            $post_title        = $data_rows["title"];
            $category          = $data_rows["category_title"];
            $admin             = $data_rows["author"];
            $image             = $data_rows["image"];
            $post_description  = $data_rows["post"];
        ?>
        <div class="card mb-3">
          <a href="post_full.php?id=<?php echo $postId; ?>">
            <img src="uploads/<?php echo htmlentities($image); ?>" class="img-fluid card-img-top" title="<?php echo htmlentities($post_title); ?>" alt="<?php echo htmlentities($image); ?>">
          </a>
          <div class="card-body">
            <a href="post_full.php?id=<?php echo $postId; ?>"><h4 class="bard-title mb-0"><?php echo htmlentities($post_title); ?></h4></a>
            <small class="text-muted"><i class="fas fa-tag fa-flip-horizontal text-success"></i> <a href="blog.php?category=<?php echo htmlentities($category); ?>"><?php echo htmlentities($category); ?></a></small><br>
            <small class="text-muted">Written by <a href="profile_public.php?username=<?php echo htmlentities($admin); ?>" class="text-success"><?php echo htmlentities($admin); ?></a><br>
            On <?php echo htmlentities($datetime); ?></small>
            <span class="float-right fieldInfo_2 mt-1"><i class="fas fa-comment-alt text-success"></i> <?php echo  comment_approve($postId);?> Comment</span>
            <hr>
            <p class="card-text">
              <?php
                if(strlen($post_description)>150){
                  $post_description = substr($post_description,0,150)."...";
                }
                echo htmlentities($post_description);
              ?>
            </p>
            <a href="post_full.php?id=<?php echo $postId; ?>" class="btn btn-success btn-sm float-right">
              <span class="align-sub"><i class="fas fa-chevron-right"></i> Read more</span>
            </a>
          </div>
        </div>
        <?php } ?>

        <!-- Pagination -->
        <nav>
          <ul class="pagination pagination-md">

            <?php
              //$stmt->debugDumpParams();
              // select SQL_CALC_FOUND_ROWS * from ... limit 0,5
              // select FOUND_ROWS();
              $sql = substr($sql, 0, strpos($sql, "LIMIT"));
              $stmt = $connecting_db->query($sql);
              $row_pagination = $stmt->fetch();
              $total_posts = $stmt->rowCount();
              //
              $post_pagination = $total_posts/$postNum;
              $post_pagination = ceil($post_pagination);
              // echo $post_pagination;

              if($total_posts>=$postNum) {

                if($page>1) {
                  $pagePrev = $page - 1;
                } else {
                  $pagePrev = 1;
                }
                if($page<$total_posts) {
                  $pageNext = $page + 1;
                } else {
                  $pageNext = $total_posts;
                }

              ?>
              <!-- Creating backward button -->
                <li class="page-item ">
                  <a href="blog.php?page=<?php echo $pagePrev; ?>" class="page-link text-success"><i class="fas fa-chevron-left"></i></a>
                </li>
              <?php

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
                if ($pageNext <= $post_pagination) {
                ?>
                  <li class="page-item ">
                    <a href="blog.php?page=<?php echo $pageNext; ?>" class="page-link text-success"><i class="fas fa-chevron-right"></i></a>
                  </li>
                <?php
                }
              } // > $postNum
            ?>
          </ul>
        </nav>

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
