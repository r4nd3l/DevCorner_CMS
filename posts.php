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

  <title>Posts</title>
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
          <h6><i class="fas fa-edit text-success"></i> Manage blog posts</h6>
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
      <div class="col-lg-12">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <div class="card table-responsive">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Comments</th>
                <th class="text-center">Action</th>
                <th class="text-center">Preview</th>
              </tr>
            </thead>
            <?php
              global $connecting_db;
              $sql = "SELECT * FROM posts";
              $stmt = $connecting_db->query($sql);
              $sr = 0;

              while ($data_rows = $stmt->fetch()) {
                $id               = $data_rows["id"];
                $datetime         = $data_rows["datetime"];
                $post_title       = $data_rows["title"];
                $category         = $data_rows["category"];
                $admin            = $data_rows["author"];
                $image            = $data_rows["image"];
                $post_description = $data_rows["post"];
                $sr++;
            ?>
            <tbody>
              <tr>
                <td><b><?php echo $sr; ?>.</b></td>
                <td class="table-success"><?php if(strlen($post_title)>20){$post_title = substr($post_title,0,20).'..';} echo $post_title;?></td>
                <td><?php if(strlen($category)>8){$category = substr($category,0,8).'..';} echo $category;?></td>
                <td><?php if(strlen($datetime)>11){$datetime = substr($datetime,0,11).'..';} echo $datetime;?></td>
                <td class="table-secondary"><?php if(strlen($admin)>6){$admin = substr($admin,0,6).'..';} echo $admin;?></td>
                <td>
                  <!-- Modal will goes here -->
                  <p><?php echo basename($image); ?></p>
                  <img src="uploads/<?php echo $image; ?>" width="170px;">
                </td>
                <td class="text-center p-1">
                  <span class="text-success" title="Approved"><i class="far fa-clock"></i> <?php approve_comment($id);?></span>
                  <hr class="m-0">
                  <span class="badge text-secondary" title="Unapproved"><i class="fas fa-history"></i> <?php disapprove_comment($id);?></span>
                </td>
                <td class="text-center">
                  <a href="edit_post.php?id=<?php echo $id; ?>" title="Edit"><i class="fas fa-edit"></i></a>
                  <a href="delete_post.php?id=<?php echo $id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
                </td>
                <td class="text-center">
                  <a href="full_post.php?id=<?php echo $id; ?>" target="_blank" title="Live preview"><i class="fas fa-glasses"></i></a>
                </td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
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
