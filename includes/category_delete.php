<?php
  if (isset($_GET["id"])) {
    $search_query_parameter = $_GET["id"];

    $admin = $_SESSION["adminName"];
    $sql = "DELETE FROM category WHERE id='$search_query_parameter'";
    $execute = $connecting_db->query($sql);

    if ($execute) {
      $_SESSION["SuccessMessage"]= "Category deleted successfully!";
      Redirect_to("categories.php");
    }else{
      $_SESSION["ErrorMessage"]= "Something went wrong. Please try again!";
      Redirect_to("categories.php");
    }
  }
?>
