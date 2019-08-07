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
      <h1 class="text-success">Get in touch</h1>
      <h6 class="text-success">We are welcome any feedback from the public to improve our services</h6>
      <div class="row my-5">
        <div class="col-lg-4">
          <div class="card bg-success border-0">
            <div class="card-body">
              <h3 class="card-title text-white mb-4">Contact us</h3>
              <ul class="card-text text-white" style="list-style: none;">
                <li class="mb-3 d-flex"><i class="mt-1 fas fa-map-marker-alt mr-3"></i> <span>0116 Leicester - UK <br> England</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 far fa-envelope mr-3"></i> <span>info@devcorner.com</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 fab fa-telegram-plane mr-3"></i> <span>@devcorner</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 fas fa-mobile-alt mr-3"></i> <span>+44 5555 123456</span></li>
              </ul>
            </div>
            <div class="card-footer text-center bg-transparent mb-2 border-0">
              <a href="https://github.com/r4nd3l" class="text-white"><i class="fab fa-github fa-fw fa-2x"></i></a>
              <a href="https://twitter.com/MateMolnar4" class="text-white"><i class="fab fa-twitter fa-fw fa-2x mx-2"></i></a>
              <a href="https://www.linkedin.com/in/matemolnar88/" class="text-white"><i class="fab fa-linkedin-in fa-fw fa-2x"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card border border-success">
            <div class="card-body">
              <h6 class="card-title text-success mb-4">Feel free to drop us a line below!</h6>

            </div>
            <div class="card-footer bg-transparent mb-2 border-0">

            </div>
          </div>
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
