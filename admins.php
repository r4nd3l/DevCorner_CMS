<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<?php
  if(isset($_POST["Submit"])){
    $username         = $_POST["Username"];
    $name             = $_POST["Name"];
    $password         = $_POST["Password"];
    $confirm_password = $_POST["Confirm_password"];
    $admin            = $_SESSION["userName"];

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y %B %d - %H:%M:%S",$current_time);

      if(empty($username) || empty($password) || empty($confirm_password)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out!";
        Redirect_to("admins.php");
      }elseif (strlen($password)<7) {
        $_SESSION["ErrorMessage"] = "Password should be at least 6 character!";
        Redirect_to("admins.php");
      }elseif ($password !== $confirm_password) {
        $_SESSION["ErrorMessage"] = "Password and confirm password should match!";
        Redirect_to("admins.php");
      }elseif (check_username_exists($username)) {
        $_SESSION["ErrorMessage"] = "Username is already exists! Try another one!";
        Redirect_to("admins.php");
      }else{
        // Query to insert new admin in DB when everything is fine
        global $connecting_db;
        $sql = "INSERT INTO admins(datetime,username,password,admin_name,added_by)";
        $sql .= "VALUES(:dateTime,:userName,:password,:admin_name,:added_by)";
        $stmt = $connecting_db->prepare($sql);
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':userName',$username);
        $stmt->bindValue(':password',$password);
        $stmt->bindValue(':admin_name',$name);
        $stmt->bindValue(':added_by',$admin);
        $execute = $stmt->execute();

        if($execute){
          $_SESSION["SuccessMessage"]= "New admin ". $name ." added successfully!";
          Redirect_to("admins.php");
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
          Redirect_to("admins.php");
        }
      }
    } // Ending of Submit button if-condition
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
  <link rel="stylesheet" href="css/styles.css">

  <title>Admin page</title>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">

      <!-- Logo part -->
      <a href="" class="navbar-brand"><i class="fas fa-code text-success"></i> DevCorner</a>

      <!-- The button for "Collapsable munu" -->
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_CMS">
        <span class="navbar-toggler-icon text-white"></span>
      </button>

      <!-- Collapsable menu -->
      <div class="collapse navbar-collapse" id="navbar_collapse_CMS">
        <!-- Menu part -->
        <ul class="navbar-nav m-auto">
          <li class="nav-item"><a href="myProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a></li>
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
          <li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
          <li class="nav-item"><a href="admins.php" class="nav-link">Manage Admins</a></li>
          <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
          <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Live Blog</a></li>
        </ul>

        <!-- Login/out part -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="logout.php" class="btn btn-light btn-sm nav-link">
              <span class="align-sub"><i class="fas fa-sign-out-alt"></i> Logout</span>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-user text-success"></i> Manage admins</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <form class="" action="admins.php" method="post">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new admin</h5>
            </div>
            <div class="card-body">
              <!-- Username -->
              <div class="form-group">
                <label for="username" class="m-0"><span class="fieldInfo">Username:</span></label>
                <input class="form-control" type="text" name="Username" id="username" placeholder="Type username here" value="">
              </div>
              <!-- Name -->
              <div class="form-group">
                <label for="name" class="m-0"><span class="fieldInfo">Name:</span></label>
                <span class="fieldInfo_2 text-muted float-right pt-1">(This is optional)</span>
                <input class="form-control" type="text" name="Name" id="name" placeholder="Type name here" value="">
              </div>
              <!-- Password -->
              <div class="form-group">
                <label for="password" class="m-0"><span class="fieldInfo">Password:</span></label>
                <input class="form-control" type="password" name="Password" id="password" value="">
              </div>
              <!-- Confirm password -->
              <div class="form-group">
                <label for="confirm_password" class="m-0"><span class="fieldInfo">Confirm password:</span></label>
                <input class="form-control" type="password" name="Confirm_password" id="confirm_password" value="">
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="dashboard.php" class="btn btn-light btn-sm border">
                    <span class="align-sub"><i class="fas fa-arrow-left"></i> Back to dashboard</span>
                  </a>
                  <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
                    <span class="align-sub"><i class="fas fa-check"></i> Publish</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Delete existing admins -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <!--  -->
        <h5><i class="fas fa-user-slash text-success"></i> Delete existing admin</h5>
        <div class="card">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th><b>#</b></th>
                <th>Date & Time</th>
                <th>Username</th>
                <th>Admin name</th>
                <th>Added by</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

          <?php
            global $connecting_db;
            $sql = "SELECT * FROM admins ORDER BY id desc";
            $execute = $connecting_db->query($sql);
            $sr_no = 0;

            while ($data_rows = $execute->fetch()) {
              $admin_id       = $data_rows["id"];
              $admin_date     = $data_rows["datetime"];
              $admin_username = $data_rows["username"];
              $admin_name     = $data_rows["admin_name"];
              $added_by       = $data_rows["added_by"];
              $sr_no++;
          ?>
            <tbody>
              <tr>
                <td><b><?php echo htmlentities($sr_no); ?>.</b></td>
                <td><?php echo htmlentities($admin_date); ?></td>
                <td class="table-secondary"><?php echo htmlentities($admin_username); ?></td>
                <td class="table-success"><?php echo htmlentities($admin_name); ?></td>
                <td class="table-success"><?php echo htmlentities($added_by); ?></td>
                <td class="text-center">
                  <a href="delete_admin.php?id=<?php echo $admin_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
            </tbody>
          <?php } ?>
          </table>
        </div>
        <!--  - END -->

      </div>
    </div>
  </section>
  <!-- Delete existing admins - END -->
  <!-- Main part - END -->

  <!-- Footer part --><!-- fixed-bottom -->
  <footer class="bg-light border-top">
    <div class="container">
      <div class="row m-3">
        <div class="col">
          <p class="lead text-center">Theme by DevCorner - <span id="year"></span></p>
          <p class="text-center small">
            This site is only used for a case-study of <br>
            <a href="https://github.com/r4nd3l"><i class="fas fa-code text-success" style="cursor: pointer; text-decoration: none;"></i> DevCorner Community</a> -
            The independent web developer community
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer part - END -->


  <!-- CDNs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- Custom scripts -->
  <script type="text/javascript">$('#year').text(new Date().getFullYear());</script>

</body>
</html>
