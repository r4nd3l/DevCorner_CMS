<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<!-- Contact form -->
<?php include('form_process.php'); ?>
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
    <section class="container mt-5" style="margin-bottom: 20vh;">
      <h1 class="text-success">Get in touch</h1>
      <h6 class="text-secondary">We are welcome any feedback from the public to improve our services</h6>
      <div class="row my-5">
        <div class="col-lg-4">
          <div class="card bg-success border-0" style="min-height: 100%;">
            <div class="card-body">
              <h3 class="card-title text-white mb-4">Contact us</h3>
              <ul class="card-text text-white" style="list-style: none;">
                <li class="mb-3 d-flex"><i class="mt-1 fas fa-map-marker-alt mr-3"></i> <span>0116 Leicester - UK <br> England</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 far fa-envelope mr-3"></i> <span>info@devcorner.com</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 fab fa-telegram-plane mr-3"></i> <span>@devcorner</span></li>
                <li class="mb-3 d-flex"><i class="mt-1 fas fa-mobile-alt mr-3"></i> <span>+44 5555 123456</span></li>
              </ul>
            </div>
            <hr class="border-white">
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
              <h4 class="card-title text-secondary mb-4">Feel free to drop us a line below!</h4>
              <hr>
              <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                  <label for="_name">Full name</label>
                  <input class="form-control" id="_name" aria-describedby="_nameHelp" placeholder="Your name" type="text" tabindex="1" name="name" value="<?= $name ?>" autofocus>
                  <small id="_nameHelp" class="form-text text-danger">&nbsp;<?= $name_error ?></small>
                </div>
                <div class="form-group">
                  <label for="_email">Email address</label>
                  <input class="form-control" id="_email" aria-describedby="_emailHelp" placeholder="Your Email Address" type="text" name="email" value="<?= $email ?>" tabindex="2">
                  <small id="_emailHelp" class="form-text text-danger">&nbsp;<?= $email_error ?></small>
                </div>
                <div class="form-group">
                  <label for="_phone">Phone number</label>
                  <input class="form-control" id="_phone" aria-describedby="_phoneHelp" placeholder="Your Phone Number" type="text" name="phone" value="<?= $phone ?>" tabindex="3">
                  <small id="_phoneHelp" class="form-text text-danger">&nbsp;<?= $phone_error ?></small>
                </div>
                <div class="form-group">
                  <label for="_website">Website address</label>
                  <input class="form-control" id="_website" aria-describedby="_websiteHelp" placeholder="Your Website starts with http://" type="text" name="url" value="<?= $url ?>" tabindex="4">
                  <small id="_websiteHelp" class="form-text text-danger">&nbsp;<?= $url_error ?></small>
                </div>
                <div class="form-group">
                  <label for="_message">Message</label>
                  <textarea class="form-control" id="_message" placeholder="Type your Message Here...." type="text" name="message" value="<?= $message ?>" tabindex="5"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-success float-right" name="submit" type="submit" data-submit="...Sending">Submit</button>
                </div>
                <span class="text-success"><?= $success; ?></span>
              </form>
            </div>
            <div class="card-footer bg-transparent mb-2 border-0">
              <!-- Footer -->
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
