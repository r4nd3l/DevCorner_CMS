<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  switch ($_REQUEST['a']) {
    case 'delete_admin':
        include('includes/delete_admin.php');
      break;
  }
?>
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
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

  <title>Admin page</title>
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
          <h6><i class="fas fa-user text-success"></i> Manage admins</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
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
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <!--  -->
        <h5><i class="fas fa-user-slash text-success"></i> Delete existing admin</h5>
        <div class="card table-responsive">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th><b>#</b></th>
                <th>Date</th>
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
                <td class="text-muted"><?php echo htmlentities($admin_date); ?></td>
                <td><a href="profile.php?username=<?php echo htmlentities($admin_username); ?>" target="_blank" title="Public profile"><?php echo htmlentities($admin_username); ?></a></td>
                <td class="text-muted"><?php echo htmlentities($admin_name); ?></td>
                <td class="text-muted"><?php echo htmlentities($added_by); ?></td>
                <td class="text-center">
                  <a href="admins.php?a=delete_admin&id=<?php echo $admin_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
