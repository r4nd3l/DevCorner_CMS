<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>Dashboard</title>
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
          <h6><i class="fas fa-cog text-success"></i> Dashboard</h6>
        </div>

        <div class="col-lg-3 mb-2">
          <!-- Add new post -->
          <a href="add_new_post.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-file-alt"></i> Add new post</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new category -->
          <a href="categories.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-folder-plus"></i> Add new category</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new admin -->
          <a href="admins.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-user-plus"></i> Add new admin</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Approve comment -->
          <a href="comments.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-check"></i> Approve comment</span>
          </a>
        </div>

      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">

      <!-- Left side area -->
      <div class="col-lg-2">
        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Posts</h6>
            <h5 class=""><i class="fab fa-readme"></i> <?php total_posts();?></h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Categories</h6>
            <h5 class=""><i class="fas fa-inbox"></i> <?php total_categories(); ?></h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Admins</h6>
            <h5 class=""><i class="fas fa-users"></i> <?php total_admins(); ?></h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Comments</h6>
            <h5 class=""><i class="fas fa-comments"></i> <?php total_comments(); ?></h5>
          </div>
        </div>
      </div>
      <!-- Left side area - END -->

      <!-- Right side area -->
      <div class="col-lg-10">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <h5><i class="fab fa-readme text-success"></i> Top posts</h5>
        <div class="card table-responsive">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th><b>#</b></th>
                <th>Title</th>
                <th>Date</th>
                <th>Author</th>
                <th class="text-center">Comments</th>
                <th class="text-center">Preview</th>
              </tr>
            </thead>
            <?php
              $sr_no = 0;
              global $connecting_db;
              $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt = $connecting_db->query($sql);

              while ($data_rows = $stmt->fetch()) {
                $post_id = $data_rows["id"];
                $datetime = $data_rows["datetime"];
                $author = $data_rows["author"];
                $title = $data_rows["title"];
                $sr_no++;
            ?>
            <tbody>
              <tr>
                <td><b><?php echo $sr_no; ?></b>.</td>
                <td class="table-success"><?php echo $title; ?></td>
                <td><?php echo $datetime; ?></td>
                <td class="table-secondary"><?php echo $author; ?></td>
                <td class="text-center p-1">
                  <span class="text-success" title="Approved"><i class="far fa-clock"></i> <?php approve_comment($post_id);?></span>
                  <hr class="m-0">
                  <span class="badge text-secondary" title="Unapproved"><i class="fas fa-history"></i> <?php disapprove_comment($post_id);?></span>
                </td>
                <td class="text-center">
                  <a href="full_post.php?id=<?php echo $post_id; ?>" title="Live preview" target="_blank"><i class="fas fa-glasses"></i></a>
                </td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
      </div>
      <!-- Right side area - END -->
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
