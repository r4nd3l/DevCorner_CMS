<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php
  // Reset all the sessions
  $_SESSION["user_id"]= null;
  $_SESSION["userName"]= null;
  $_SESSION["adminName"]= null;

  session_destroy();
  Redirect_to("login.php");
?>
