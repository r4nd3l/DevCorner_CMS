<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>User profile</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/navbar_public.php"); ?>
  <!-- Navbar - END -->

  <!-- Main part -->
    <section class="container mt-5">
      <!-- Decsription -->
      <div class="row my-5">
        <div class="col-lg-12">
          <h5 class="text-success">Changelog</h5>
          <h6 class="text-secondary">To get a better overview</h6>
          <div class="card bg-success border-0">
            <div class="card-body">
              <p class="card-text text-white text-justify">
                This CMS is based on a case study under the rights of the DevCorner Community.
                This particular project is meant for those rookie web developers whose would like to know how to code a <i>simple blog CMS</i> using PHP.
                In order to get a better view of each update, we decided to create a <i>changelog</i> section where the major updates can be seen.
              </p>
              <p class="card-text text-white text-justify text-right">More will come, stay tuned! <br>
                <small>by DevCorner Community</small>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Changelog -->
      <div class="row">
        <div class="col-lg-12">
          Content will goes here..
        </div>
      </div>
    </section>
  <!-- Main part - END -->

  <!-- Footer part --><!-- fixed-bottom -->
    <?php require_once("partials/footer.php"); ?>
  <!-- Footer part - END -->

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
