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
      <div class="row my-5">
        <div class="col-lg-8">
          <h1 class="display-2 text-success">The Community Behind</h1>
          <h2 class="mt-5">Web developer group for coding</h2>
          <h5 class="text-justify mt-4">A web developer is a programmer who specializes in, or is specifically engaged in, the development of World Wide Web applications, or applications that are run over HTTP from a web server to a web browser.</h5>
          <h5 class="text-justify mt-4">Web developers are found working in various types of organizations, including large corporations and governments, small and medium - sized companies, or alone as freelancers.</h5>
          <a href="https://github.com/r4nd3l" target="_blank"><button type="button" class="float-right btn-sm btn btn-success mt-3">Our sources</button></a>
        </div>
        <div class="col-lg-4">
          <img class="" src="img/bulb.jpg" alt="" class="img-fluid">
        </div>
      </div>
      <hr class="my-5">
      <div class="row">
        <div class="col-lg-12 mb-5">
          <div class="about-section">
            <div class="inner-width">
              <h1>Our indicators</h1>
              <div class="border"></div>
              <div class="about-section-row">
                <div class="about-section-col">
                  <div class="about">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga provident ea hic, neque amet sequi temporibus iure aliquid placeat inventore. Quae dolores dolore, cum nulla quas ipsum facere maxime, necessitatibus!</p>
                    <a href="https://github.com/r4nd3l?tab=repositories" target="_blank"><button type="button" class="btn btn-sm btn-outline-success mt-3">Read More</button></a>
                  </div>
                </div>
                <div class="about-section-col">
                  <div class="skills">
                    <div class="skill">
                      <div class="title">Web Design</div>
                      <div class="progress">
                        <div class="progress-bar p1"><span>90%</span></div>
                      </div>
                    </div>

                    <div class="skill">
                      <div class="title">UI Design</div>
                      <div class="progress">
                        <div class="progress-bar p2"><span>70%</span></div>
                      </div>
                    </div>

                    <div class="skill">
                      <div class="title">UX Design</div>
                      <div class="progress">
                        <div class="progress-bar p3"><span>50%</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
