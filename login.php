<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  if (isset($_SESSION["user_id"])) {
    Redirect_to("dashboard.php");
  }

  if (isset($_POST["Submit"])) {
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    if (empty($username) || empty($password)) {
      $_SESSION["ErrorMessage"]= "All fields must be filled out";
      Redirect_to("login.php");
    }else{
      // code for checking username and password from DB
      $found_account = login_attempt($username, $password);
      if ($found_account) {
        $_SESSION["user_id"]= $found_account["id"];
        $_SESSION["userName"]= $found_account["username"];
        $_SESSION["adminName"]= $found_account["admin_name"];

        $_SESSION["SuccessMessage"]= "Welcome back ". $_SESSION["adminName"]." admin!";
        if (isset($_SESSION["tracking_URL"])) {
          Redirect_to($_SESSION["tracking_URL"]);
        }else{
          Redirect_to("dashboard.php");
        }

      }else{
        $_SESSION["ErrorMessage"]= "Incorrect Username or Password";
        Redirect_to("login.php");
      }
    }
  }
?>
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

  <title>Login</title>
</head>
<body>

  <!-- Navbar -->
    <?php require_once("partials/public_navbar.php"); ?>
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-sm-3 col-sm-6">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <div class="card">
          <div class="card-header">
            <h4 class="fieldInfo m-0">Welcome back!</h4>
            </div>
            <div class="card-body">
            <form class="" action="login.php" method="post">

              <!-- Username -->
              <div class="form-group">
                <label for="username" class="m-0"><span class="fieldInfo">Username:</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-user"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="Username" id="username" placeholder="username">
                </div>
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password" class="m-0"><span class="fieldInfo">Password:</span></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="Password" id="password" placeholder="password">
                </div>
              </div>
              <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
                <span class="align-sub"><i class="fas fa-sign-in-alt"></i> Login</span>
              </button>
            </form>
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
