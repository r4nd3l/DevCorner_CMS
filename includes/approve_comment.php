<?php
  if (isset($_GET["id"])) {
    $search_query_parameter = $_GET["id"];

    $admin = $_SESSION["adminName"];
    $sql = "UPDATE comments SET status='ON', approved_by='$admin' WHERE id='$search_query_parameter'";
    $execute = $connecting_db->query($sql);

    if ($execute) {
      $_SESSION["SuccessMessage"]= "Comment approved successfully!";
      Redirect_to("comments.php");
    }else{
      $_SESSION["ErrorMessage"]= "Something went wrong. Please try again!";
      Redirect_to("comments.php");
    }
  }
?>
