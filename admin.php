<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<?php
  global $merged_content;
  switch ($_REQUEST['a']) {
    case 'posts':
        include('posts.php');
      break;
      case 'comments':
          include('comments.php');
        break;
    case 'approve_comment':
        include('includes/approve_comment.php');
      break;
    case 'delete_comment':
        include('includes/delete_comment.php');
      break;
  }
?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title><?php echo $merged_title; ?></title>
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
          <h6><i class="fas fa-comments text-success"></i> Manage <?php echo $merged_title; ?></h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
    <section class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <?php
            echo ErrorMessage();
            echo SuccessMessage();
          ?>
        </div>
      </div>
    </section>
  <!-- Main part - END -->

  <?php
    echo $merged_content;// :)
  ?>

  <!-- Footer part --><!-- fixed-bottom -->
    <?php require_once("partials/footer.php"); ?>
  <!-- Footer part - END -->

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
