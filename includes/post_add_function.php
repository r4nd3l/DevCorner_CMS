<?php

  if(isset($_POST["Submit"])){
    $post_title       = $_POST["post_title"];
    $category         = $_POST["category"];
    $image            = $_FILES["image_upload"]["name"];
    $target           =  "uploads/".basename($_FILES["image_upload"]["name"]);
    $post_description = $_POST["post_description"];
    $admin            = $_SESSION["userName"];

    // Data and time settings
    date_default_timezone_set("Europe/Budapest");
    $current_time = time();
    $datetime     = strftime("%Y.%m.%d - %H:%M:%S",$current_time);
    // $datetime     = strftime("%Y %b %d - %H:%M:%S",$current_time);

      if(empty($post_title)){
        $_SESSION["ErrorMessage"] = "Title is empty!";
        Redirect_to("admin_private.php?a=dashboard#sec_posts");
      }elseif (strlen($post_title)<5) {
        $_SESSION["ErrorMessage"] = "Post title should be greater than 2 characters!";
        Redirect_to("admin_private.php?a=dashboard#sec_posts");
      }elseif (strlen($post_description)>9999) {
        $_SESSION["ErrorMessage"] = "The text is too long!";
        Redirect_to("admin_private.php?a=dashboard#sec_posts");
      }else{
        // Query to insert post in DB when everything is fine
        global $connecting_db;
        $sql = "INSERT INTO posts(datetime,title,category_id,author,image,post)";
        $sql .= "VALUES(:dateTime,:postTitle,:categoryId,:adminName,:imageName,:postDescription)";
        $stmt = $connecting_db->prepare($sql);
        $stmt->bindValue(':dateTime',$datetime);
        $stmt->bindValue(':postTitle',$post_title);
        $stmt->bindValue(':categoryId',$category);
        $stmt->bindValue(':adminName',$admin);
        $stmt->bindValue(':imageName',$image);
        $stmt->bindValue(':postDescription',$post_description);
        $execute = $stmt->execute();

        // Moving the uploaded image to the 'uploads' directory
        move_uploaded_file($_FILES["image_upload"]["tmp_name"],$target);

        if($execute){
          $_SESSION["SuccessMessage"]="Post with id: ". $connecting_db->lastInsertId() ." added successfully!";
        }else{
          $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
        }
        Redirect_to("admin_private.php?a=dashboard#sec_posts");
      }
    } // Ending of Submit button if-condition
?>
