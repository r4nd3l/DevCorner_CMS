<?php

  // Fetching the existing admin data start
  $admin_id = $_SESSION["user_id"];

  if(isset($_POST["Submit"])){
    $admin_name     = $_POST["admin_name"];
    $admin_headline = $_POST["admin_headline"];
    $admin_bio      = $_POST["admin_bio"];
    $admin_image    = $_FILES["image_upload"]["name"];
    $target         =  "img/".basename($_FILES["image_upload"]["name"]);

    if (strlen($admin_headline)>50) {
      $_SESSION["ErrorMessage"] = "Headline is too long! (maximum is 50 character)";
      Redirect_to("admin.php?a=profile_private");
    }elseif (strlen($admin_bio)>500) {
      $_SESSION["ErrorMessage"] = "Bio text is too long! (maximum is 500 character)";
      Redirect_to("admin.php?a=profile_private");
    }else{
      // Query to update admin data in DB when everything is fine
      global $connecting_db;
      if (!empty($_FILES["image_upload"]["name"])) {
        $sql = "UPDATE admins
                SET admin_name='$admin_name', admin_headline='$admin_headline', admin_bio='$admin_bio', admin_image='$admin_image'
                WHERE id='$admin_id'";
      }else{
        $sql = "UPDATE admins
                SET admin_name='$admin_name', admin_headline='$admin_headline', admin_bio='$admin_bio'
                WHERE id='$admin_id'";
      }
      $execute = $connecting_db->query($sql);

      // Moving the uploaded image to the 'uploads' directory
      move_uploaded_file($_FILES["image_upload"]["tmp_name"],$target);

      if($execute){
        $_SESSION["SuccessMessage"]="Details updated successfully!";
      }else{
        $_SESSION["ErrorMessage"]="Something went wrong.. Please try again!";
      }
      Redirect_to("admin.php?a=profile_private");
    }
  } // Ending of Submit button if-condition
?>
