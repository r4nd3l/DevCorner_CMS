<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  if (isset($_GET["id"])) {
    $search_query_parameter = $_GET["id"];

    global $connecting_db;
    $admin = $_SESSION["adminName"];
    $sql = "UPDATE comments SET status='OFF', approved_by='$admin' WHERE id='$search_query_parameter'";
    $execute = $connecting_db->query($sql);

    if ($execute) {
      $_SESSION["SuccessMessage"]= "Comment disapproved successfully!";
      Redirect_to("comments.php");
    }else{
      $_SESSION["ErrorMessage"]= "Something went wrong. Please try again!";
      Redirect_to("comments.php");
    }
  }
?>