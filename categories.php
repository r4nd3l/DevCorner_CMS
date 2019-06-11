<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php $_SESSION["tracking_URL"]= $_SERVER["PHP_SELF"]; confirm_login(); ?>
<?php
  if(isset($_POST["Submit"])){
    $category = $_POST["category_title"];
    $admin    = $_SESSION["userName"];

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y %B %d - %H:%M:%S",$current_time);

      if(empty($category)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out!";
        Redirect_to("categories.php");
      }elseif (strlen($category)<3) {
        $_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters!";
        Redirect_to("categories.php");
      }elseif (strlen($category)>49) {
        $_SESSION["ErrorMessage"] = "Category title should be shorter!";
        Redirect_to("categories.php");
      }else{
        // Query to insert category in DB when everything is fine
        global $connecting_db;
        $sql = "INSERT INTO category(title,author,datetime)";
        $sql .= "VALUES(:categoryName,:adminName,:dateTime)";
        $stmt = $connecting_db->prepare($sql);
        $stmt->bindValue(':categoryName',$category);
        $stmt->bindValue(':adminName',$admin);
        $stmt->bindValue(':dateTime',$datetime);
        $execute = $stmt->execute();

        if($execute){
          $_SESSION["SuccessMessage"]="Category with id: ". $connecting_db->lastInsertId() ." added successfully!";
          Redirect_to("categories.php");
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
          Redirect_to("categories.php");
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
  <!-- Custom Style -->
<link rel="stylesheet" href="css/styles.css" type="text/css">

<!-- Google Fonts Roboto - Fallback -->
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 

  <title>Categories</title>
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
          <h6><i class="fas fa-edit text-success"></i> Manage categories</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <!-- Add new category -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <form class="" action="categories.php" method="post">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new category</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Category title:</span></label>
                <input class="form-control" type="text" name="category_title" id="title" placeholder="Type title here" value="">
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
  <!-- Add new category - END -->

  <!-- Delete existing category -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <?php
          echo ErrorMessage();
          echo SuccessMessage();
        ?>
        <!--  -->
        <h5><i class="fas fa-inbox text-success"></i> Existing categories</h5>
        <div class="card">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th><b>#</b></th>
                <th>Date & Time</th>
                <th>Category</th>
                <th>Creator</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

          <?php
            global $connecting_db;
            $sql = "SELECT * FROM category ORDER BY id desc";
            $execute = $connecting_db->query($sql);
            $sr_no = 0;

            while ($data_rows = $execute->fetch()) {
              $category_id   = $data_rows["id"];
              $category_date = $data_rows["datetime"];
              $category_name = $data_rows["title"];
              $creator_name  = $data_rows["author"];
              $sr_no++;
          ?>
            <tbody>
              <tr>
                <td><b><?php echo htmlentities($sr_no); ?>.</b></td>
                <td><?php echo htmlentities($category_date); ?></td>
                <td class="table-secondary"><?php echo htmlentities($category_name); ?></td>
                <td class="table-success"><?php echo htmlentities($creator_name); ?></td>
                <td class="text-center">
                  <a href="delete_category.php?id=<?php echo $category_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
  <!-- Delete existing category - END -->
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
