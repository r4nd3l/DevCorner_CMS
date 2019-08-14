<div class="card line_top">
  <div class="card-body">
    <a href="https://github.com/r4nd3l" target="_blank" title="GitHub Repo">
      <img src="img/devcorner_card.png" class="d-block img-fluid mb-3 rounded" alt="side_banner">
    </a>
    <div class="text-justify">
      <h6 class="font-weight-bold">Join to our community and be part of the web developers team!</h6>
      <ul class="m-0">
        <li>Immersive coding bootcamp</li>
        <li>Growing developer forum</li>
        <li>DevCorner network</li>
      </ul>
    </div>
  </div>
</div>
<br>
<div class="card line_top">
  <div class="card-header text-secondary text-center p-2">
    <h2 class="lead m-0">Subscribe to our monthly</h2>
    <h2 class="m-0"><i class="far fa-newspaper text-success"></i> NEWSLETTER</h2>
    <small>Start receiving our monthly newsletter right away!</small>
  </div>
  <div class="card-body p-3">
    <div class="input-group">
      <input type="text" class="form-control" name="" placeholder="Add your email">
      <div class="input-group-append">
        <button class="btn btn-success btn-sm text-center text-white">
          <h6 class="m-0"><i class="far fa-paper-plane fa-fw"></i> Send</h6>
        </button>
      </div>
    </div>
  </div>
</div>
<br>

<div class="card line_top">
  <div class="card-header text-secondary p-2">
    <h2 class="lead m-0"><i class="fas fa-asterisk fa-fw text-success"></i> Categories</h2>
  </div>
  <div class="card-body text-justify p-3">
    <?php
    global $connecting_db;
    $sql = "SELECT * FROM category ORDER BY id desc";
    $stmt = $connecting_db->query($sql);

    while ($data_rows = $stmt->fetch()) {
      $category_id = $data_rows["id"];
      $category_name = $data_rows["title"];
      ?>
      <span class="line_left">
        <a class="border rounded mr-1" href="blog.php?category=<?php echo $category_name; ?>"><span class="mx-1"><?php echo $category_name; ?></span></a>
      </span>
    <?php } ?>
  </div>
</div>
<br>

<div class="card line_top">
  <div class="card-header text-secondary p-2">
    <h2 class="lead m-0"><i class="fas fa-file fa-fw text-success"></i> Recent posts</h2>
  </div>
  <div class="card-body p-3">
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
      <div class="rounded line_right mb-3 _last">
        <div class="media border rounded bg-light">
          <a href="post_full.php?id=<?php echo htmlentities($id); ?>">
            <img src="uploads/<?php echo htmlentities($image); ?>" class="d-block img-fluid align-self-start rounded-left" width="130" alt="<?php echo htmlentities($title); ?>" title="<?php echo basename(htmlentities($image)); ?>">
          </a>
          <div class="media-body mx-2">
            <a href="post_full.php?id=<?php echo htmlentities($id); ?>">
              <p class="lead fs_4 text-justify mt-1"><?php if(strlen($title)>40){$title = substr($title,0,40).'..';} echo htmlentities($title); ?></p>
            </a>
            <p class="mb-0 fs_3"><?php echo htmlentities($datetime); ?></p>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
