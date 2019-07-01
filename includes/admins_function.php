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
        Redirect_to("admin_private.php?a=admins");
      }elseif (strlen($password)<7) {
        $_SESSION["ErrorMessage"] = "Password should be at least 6 character!";
        Redirect_to("admin_private.php?a=admins");
      }elseif ($password !== $confirm_password) {
        $_SESSION["ErrorMessage"] = "Password and confirm password should match!";
        Redirect_to("admin_private.php?a=admins");
      }elseif (check_username_exists($username)) {
        $_SESSION["ErrorMessage"] = "Username is already exists! Try another one!";
        Redirect_to("admin_private.php?a=admins");
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
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
        }
        Redirect_to("admin_private.php?a=admins");
      }
    } // Ending of Submit button if-condition
?>
