<?php
  $merged_title = 'Dashboard';
  $recent_icon = '<i class="fas fa-home text-success"></i>';
  $merged_content .= '

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        ';?>

        <!-- Indicators - SECTION -->
        <?php require_once('indicators.php'); ?>

        <!-- Indicators - SECTION -->
        <?php require_once('posts.php'); ?>

        <!-- Indicators - SECTION -->
        <?php require_once('categories.php'); ?>

        <!-- Indicators - SECTION -->
        <?php require_once('admins.php'); ?>

        <!-- Indicators - SECTION -->
        <?php require_once('comments.php'); ?>

        <?php $merged_content .='
      </div>
    </div>
  </section>
  <!-- Main part - END -->

  <!-- Modal for XYZ -->

  <!-- Modal for XYZ - END -->

';
?>
