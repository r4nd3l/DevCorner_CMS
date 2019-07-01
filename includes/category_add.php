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
        Redirect_to("admin_private.php?a=categories");
      }elseif (strlen($category)<3) {
        $_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters!";
        Redirect_to("admin_private.php?a=categories");
      }elseif (strlen($category)>49) {
        $_SESSION["ErrorMessage"] = "Category title should be shorter!";
        Redirect_to("admin_private.php?a=categories");
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
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
        }
        Redirect_to("admin_private.php?a=categories");
      }
    } // Ending of Submit button if-condition
?>
