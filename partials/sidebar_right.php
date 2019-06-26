<div class="card mt-4">
  <div class="card-body">
    <img src="img/img_05.jpeg" class="d-block img-fluid mb-3" alt="side_banner">
    <div class="text-justify">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati soluta quidem quis error voluptatem, voluptatibus ratione ducimus officia, ipsa, iste velit ut in eius? Vitae quibusdam magni quos sint eius.
    </div>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header bg-dark text-light">
    <h2 class="lead">Sign up!</h2>
  </div>
  <div class="card-body">
    <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the forum</button>
    <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="" placeholder="Enter your email">
      <div class="input-group-append">
        <button class="btn btn-primary btn-sm text-center text-white">Subscribe now!</button>
      </div>
    </div>
  </div>
</div>
<br>

<div class="card">
  <div class="card-header bg-primary text-light">
    <h2 class="lead">Categories</h2>
  </div>
  <div class="card-body">
    <?php
    global $connecting_db;
    $sql = "SELECT * FROM category ORDER BY id desc";
    $stmt = $connecting_db->query($sql);

    while ($data_rows = $stmt->fetch()) {
      $category_id = $data_rows["id"];
      $category_name = $data_rows["title"];
      ?>
      <a href="blog.php?category=<?php echo $category_name; ?>"><span class="heading"><?php echo $category_name; ?></span></a><br>
    <?php } ?>
  </div>
</div>
<br>

<div class="card">
  <div class="card-header bg-info text-white">
    <h2 class="lead">Recent posts</h2>
  </div>
  <div class="card-body">
    <?php
      global $connecting_db;
      $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
      $stmt = $connecting_db->query($sql);

      while ($data_rows = $stmt->fetch()) {
        $id       = $data_rows['id'];
        $title    = $data_rows['title'];
        $datetime = $data_rows['datetime'];
        $image    = $data_rows['image'];
    ?>
      <div class="media">
        <img src="uploads/<?php echo htmlentities($image); ?>" class="d-block img-fluid align-self-start" width="90" height="90" alt="<?php echo basename(htmlentities($image)); ?>" title="<?php echo basename(htmlentities($image)); ?>">
        <div class="media-body ml-2">
          <a href="post_full.php?id=<?php echo htmlentities($id); ?>" target="_blank">
            <h6 class="lead"><?php echo htmlentities($title); ?></h6>
          </a>
          <p class="small"><?php echo htmlentities($datetime); ?></p>
        </div>
      </div>
      <hr>
    <?php } ?>
  </div>
</div>
