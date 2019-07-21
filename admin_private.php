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
    case 'post_add':
        include('includes/post_add.php');
      break;
    case 'post_add_function':
        include('includes/post_add_function.php');
      break;
    case 'comments':
        include('comments.php');
      break;
    case 'approve_comment':
        include('includes/comment_approve.php');
      break;
    case 'comment_delete':
        include('includes/comment_delete.php');
      break;
    case 'categories':
        include('categories.php');
      break;
    case 'category_delete':
        include('includes/category_delete.php');
      break;
    case 'category_add':
        include('includes/category_add.php');
      break;
    case 'indicators':
        include('indicators.php');
      break;
    case 'profile_private':
        include('profile_private.php');
      break;
    case 'profile_private_function':
        include('includes/profile_private_function.php');
      break;
    case 'admins':
        include('admins.php');
      break;
    case 'admins_function':
        include('includes/admins_function.php');
      break;
    case 'admin_delete':
        include('includes/admin_delete.php');
      break;
    case 'dashboard':
        include('dashboard.php');
      break;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title><?php echo $merged_title; ?></title>
</head>
<body>

  <!-- Sidebar - with toggle/minimize function -->
  <div id="sideBar" class="sideBar bg-success">
    <ul>
      <li><a href="javascript:void(0)" id="toggle-sideBar"><i class="fas fa-window-maximize fa-rotate-270 fa-fw mr-3 mt-1"></i> <span>Minimize</span></a></li>
      <li><a href="admin_private.php?a=dashboard" class="kolbas"><i class="fas fa-home fa-fw mr-3 mt-1"></i> <span>Dashboard</span></a><span class="retek">Dashboard</span></li>
      <li><a href="admin_private.php?a=profile_private"><i class="far fa-address-card fa-fw mr-3 mt-1"></i> <span>Profile</span></a></li>
      <li><a href="admin_private.php?a=indicators"><i class="fas fa-tachometer-alt fa-fw mr-3 mt-1"></i> <span>Indicators</span></a></li>
      <li><a href="admin_private.php?a=posts"><i class="fas fa-file-alt fa-fw mr-3 mt-1"></i> <span>Posts</span></a></li>
      <li><a href="admin_private.php?a=categories"><i class="fas fa-folder-plus fa-fw mr-3 mt-1"></i> <span>Categories</span></a></li>
      <li><a href="admin_private.php?a=admins"><i class="fas fa-users fa-fw mr-3 mt-1"></i> <span>Admins</span></a></li>
      <li><a href="admin_private.php?a=comments"><i class="fas fa-comments fa-fw mr-3 mt-1"></i> <span>Comments</span></a></li>
      <hr>
      <li><a href="blog.php?page=1"><i class="fas fa-book fa-fw mr-3 mt-1"></i> <span>LiveBlog</span></a></li>
      <li><a href="logout.php"><i class="fas fa-power-off fa-fw mr-3 mt-1"></i> <span>Logout</span></a></li>
    </ul>
  </div>
  <!-- Sidebar - with toggle/minimize function - END -->

  <div class="container-fluid p-0">
    <div id="contentBar" class="">
      <!-- Sections -->
      <div class="col-lg-12 p-0">
        <!-- Navbar -->
        <?php require_once("partials/navbar_admin.php"); ?>
        <!-- Navbar - END -->

        <!-- Header -->
        <header class="py-3">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <h6><?php echo $recent_icon; ?> <?php echo $merged_title; ?></h6>
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

        <?php echo $merged_content;?>

        <!-- Footer part --><!-- fixed-bottom -->
        <?php require_once("partials/footer.php"); ?>
        <!-- Footer part - END -->
      </div>
      <!-- Sections - END -->
    </div>
  </div>


  <!-- Scripts -->
  <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
