<?php require_once("includes/db.php"); ?>
<?php

  function Redirect_to($new_location){
    header("Location:".$new_location);
    exit;
  }
  function check_username_exists($username){
    global $connecting_db;
    $sql = "SELECT username FROM admins WHERE username=:userName";
    $stmt = $connecting_db->prepare($sql);
    $stmt->bindValue(':userName',$username);
    $stmt->execute();
    $result = $stmt->rowcount();
    if($result == 1){
      return true;
    }else{
      return false;
    }
  }

  // Login attempt verifications
  function login_attempt($username, $password){
    global $connecting_db;
    $sql = "SELECT * FROM admins WHERE username=:username AND password=:password LIMIT 1";
    $stmt = $connecting_db->prepare($sql);
    $stmt->bindValue(':username',$username);
    $stmt->bindValue(':password',$password);
    $stmt->execute();
    $result = $stmt->rowcount();

    if ($result == 1) {
      return $found_account = $stmt->fetch();
    }else{
      return null;
    }
  }

  // Login is required to change something
  function confirm_login(){
    if (isset($_SESSION["user_id"])) {
      return true;
    }else{
      $_SESSION["ErrorMessage"]= "Login required!";
      Redirect_to("login.php");
    }
  }

  // Total Posts
  function total_posts(){
    global $connecting_db;
    $sql = "SELECT COUNT(*) FROM posts";
    $stmt       = $connecting_db->query($sql);
    $total_rows = $stmt->fetch();
    $total_post = array_shift($total_rows);
    return $total_post;
  }

  // Total Categorires
  function total_categories(){
    global $connecting_db;
    $sql = "SELECT COUNT(*) FROM category";
    $stmt           = $connecting_db->query($sql);
    $total_rows     = $stmt->fetch();
    $total_category = array_shift($total_rows);
    return $total_category;
  }

  // Total Admins
  function total_admins(){
    global $connecting_db;
    $sql = "SELECT COUNT(*) FROM admins";
    $stmt         = $connecting_db->query($sql);
    $total_rows   = $stmt->fetch();
    $total_admins = array_shift($total_rows);
    return $total_admins;
  }

  // Total Comments
  function total_comments(){
    global $connecting_db;
    $sql = "SELECT COUNT(*) FROM comments";
    $stmt           = $connecting_db->query($sql);
    $total_rows     = $stmt->fetch();
    $total_comments = array_shift($total_rows);
    return $total_comments;
  }

  // Approve comments according to post
  function   comment_approve($post_id){
    global $connecting_db;
    $sql_approve  = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND status=1";
    $stmt_approve = $connecting_db->query($sql_approve);
    $total_rows   = $stmt_approve->fetch();
    $total        = array_shift($total_rows);
    return $total;
  }

  // Disapprove comments according to post
  function  comment_disapprove($post_id){
    global $connecting_db;
    $sql_disapproved  = "SELECT COUNT(*) FROM comments WHERE post_id='$post_id' AND status=0";
    $stmt_disapproved = $connecting_db->query($sql_disapproved);
    $total_rows   = $stmt_disapproved->fetch();
    $total        = array_shift($total_rows);
    return $total;
  }

  // Percentage of Posts
  function pct_posts(){
    $calc_posts = round(total_posts()*100/(total_posts()+total_categories()+total_admins()+total_comments()), 3);
    return $calc_posts;
  }

  // Percentage of Categories
  function pct_categories(){
    $calc_categories = round(total_categories()*100/(total_posts()+total_categories()+total_admins()+total_comments()), 3);
    return $calc_categories;
  }

  // Percentage of Admins
  function pct_admins(){
    $calc_admins = round(total_admins()*100/(total_posts()+total_categories()+total_admins()+total_comments()), 3);
    return $calc_admins;
  }

  // Percentage of Comments
  function pct_comments(){
    $calc_comments = round(total_comments()*100/(total_posts()+total_categories()+total_admins()+total_comments()), 3);
    return $calc_comments;
  }

?>
