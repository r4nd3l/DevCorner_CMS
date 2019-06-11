<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
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
  <!-- Custom Style -->
<link rel="stylesheet" href="css/styles.css" type="text/css">

<!-- Google Fonts Roboto - Fallback -->
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 

  <title>Comments</title>
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
          <h6><i class="fas fa-comments text-success"></i> Manage comments</h6>
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
          <!-- Unapproved table -->
          <h5><i class="far fa-clock text-success"></i> Unapproved comments</h5>
          <div class="card">
            <table class="table table-hover" style="margin-bottom: 0;">
              <thead class="thead-light">
                <tr>
                  <th><b>#</b></th>
                  <th>Date & Time</th>
                  <th>Name</th>
                  <th>Comment</th>
                  <th class="text-center">Action</th>
                  <th class="text-center">Preview</th>
                </tr>
              </thead>

            <?php
              global $connecting_db;
              $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
              $execute = $connecting_db->query($sql);
              $sr_no = 0;

              while ($data_rows = $execute->fetch()) {
                $comment_id           = $data_rows["id"];
                $datetime_of_comments = $data_rows["datetime"];
                $commenter_name       = $data_rows["name"];
                $comment_content      = $data_rows["comment"];
                $comment_post_id      = $data_rows["post_id"];
                $sr_no++;
            ?>
              <tbody>
                <tr>
                  <td><b><?php echo htmlentities($sr_no); ?>.</b></td>
                  <td><?php echo htmlentities($datetime_of_comments); ?></td>
                  <td class="table-secondary"><?php echo htmlentities($commenter_name); ?></td>
                  <td class="table-success"><?php echo htmlentities($comment_content); ?></td>
                  <td class="text-center">
                    <a href="approve_comment.php?id=<?php echo $comment_id; ?>" title="Approve"><i class="far fa-check-circle"></i></a>
                    <a href="delete_comment.php?id=<?php echo $comment_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  <td class="text-center">
                    <a href="full_post.php?id=<?php echo $comment_post_id; ?>" title="Live preview" target="_blank"><i class="fas fa-glasses"></i></a>
                  </td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
          <!-- Unapproved table - END -->

        </div>
      </div>
    </section>

    <section class="container-fluid py-2 mb-4">
      <div class="row">
        <div class="col-lg-12">
          <?php
            echo ErrorMessage();
            echo SuccessMessage();
          ?>
          <!-- Disapprove table -->
          <h5><i class="fas fa-history text-success"></i> Disapprove comments</h5>
          <div class="card">
            <table class="table table-hover" style="margin-bottom: 0;">
              <thead class="thead-light">
                <tr>
                  <th><b>#</b></th>
                  <th>Date & Time</th>
                  <th>Name</th>
                  <th>Comment</th>
                  <th class="text-center">Action</th>
                  <th class="text-center">Preview</th>
                </tr>
              </thead>

            <?php
              global $connecting_db;
              $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
              $execute = $connecting_db->query($sql);
              $sr_no = 0;

              while ($data_rows = $execute->fetch()) {
                $comment_id           = $data_rows["id"];
                $datetime_of_comments = $data_rows["datetime"];
                $commenter_name       = $data_rows["name"];
                $comment_content      = $data_rows["comment"];
                $comment_post_id      = $data_rows["post_id"];
                $sr_no++;
            ?>
              <tbody>
                <tr>
                  <td><b><?php echo htmlentities($sr_no); ?>.</b></td>
                  <td><?php echo htmlentities($datetime_of_comments); ?></td>
                  <td class="table-secondary"><?php echo htmlentities($commenter_name); ?></td>
                  <td class="table-success"><?php echo htmlentities($comment_content); ?></td>
                  <td class="text-center">
                    <a href="disapprove_comment.php?id=<?php echo $comment_id; ?>" title="Dispprove"><i class="fas fa-undo"></i></a>
                    <a href="delete_comment.php?id=<?php echo $comment_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
                  </td>
                  <td class="text-center">
                    <a href="full_post.php?id=<?php echo $comment_post_id; ?>" title="Live preview" target="_blank"><i class="fas fa-glasses"></i></a>
                  </td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
          <!-- Disapprove table - END -->

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
