<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  switch ($_REQUEST['a']) {
    case 'delete_category':
        include('includes/delete_category.php');
      break;
  }
?>
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
  <!-- Header part -->
    <?php require_once('partials/header.php'); ?>
  <!-- Header part - END -->

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
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-right">#</th>
                <th>Date</th>
                <th>Category</th>
                <th>Creator</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
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
            <tr>
              <td class="text-right font-weight-bold w_005"><b><?php echo htmlentities($sr_no); ?>.</b></td>
              <td class="text-muted w_015"><?php echo htmlentities($category_date); ?></td>
              <td class="font-weight-bold w_020"><a href="blog.php?category=<?php echo $category_name; ?>" target="_blank" title="View all"><?php echo htmlentities($category_name); ?></a></td>
              <td class="w_055"><a href="profile.php?username=<?php echo htmlentities($creator_name); ?>" target="_blank" title="Public profile"><?php echo htmlentities($creator_name); ?></a></td>
              <td class="text-center w_005">
                <a href="categories.php?a=delete_category&id=<?php echo $category_id; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
            <?php } ?>
            </tbody>
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

  <!-- Scripts -->
    <?php require_once("partials/scripts.php"); ?>
  <!-- Scripts - END -->

</body>
</html>
