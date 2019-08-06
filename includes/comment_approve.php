<?php
  if (isset($_GET["id"])) {
    $search_query_parameter = $_GET["id"];

    $admin = $_SESSION["adminName"];
    $sql = "UPDATE comments SET status = not status, approved_by='$admin' WHERE id='$search_query_parameter'";
    $execute = $connecting_db->query($sql);

    if ($execute) {
      $_SESSION["SuccessMessage"]= "Comment approved status changed successfully!";
    }else{
      $_SESSION["ErrorMessage"]= "Something went wrong. Please try again!";
    }
    Redirect_to("admin_private.php?a=dashboard#sec_comments");
  }
?>
