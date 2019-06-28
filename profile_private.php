<?php
  $merged_title = 'Profile private';

  // Fetching the existing admin data start
  $admin_id = $_SESSION["user_id"];
  global $connecting_db;
  $sql = "SELECT * FROM admins WHERE id='$admin_id'";
  $stmt = $connecting_db->query($sql);

  while ($data_rows = $stmt->fetch()) {
    $existing_name     = $data_rows["admin_name"];
    $existing_username = $data_rows["username"];
    $existing_headline = $data_rows["admin_headline"];
    $existing_bio      = $data_rows["admin_bio"];
    $existing_image    = $data_rows["admin_image"];
  }

  $merged_content .= '

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-user text-success"></i> '.$existing_username.'</h6>
          <small class="text-success">'.$existing_headline.'</small>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <!-- Left column -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-dark text-light">
            <h3>'.$existing_name.'</h3>
          </div>
          <div class="card-body">
            <img src="img/'.$existing_image.'" class="block img-fluid" alt="'. $existing_image.'">
            <div class="">'. $existing_bio.'</div>
          </div>
        </div>
      </div>
      <!-- Left column - END -->

      <div class="col-lg-9" style="">
        <form class="" action="admin.php?a=profile_private_function" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Edit profile</h5>
            </div>

            <div class="card-body">
              <div class="form-group">
                <input class="form-control" type="text" name="admin_name" id="my_name" placeholder="Your name" value="">
              </div>

              <div class="form-group">
                <input class="form-control" type="text" id="my_name" placeholder="Headline" name="admin_headline">
                <small class="text-muted">Add a professional headline like, \'Web developer\' at DevCorner
                  <span class="text-danger">Not more than 50 characters</span>
                </small>
              </div>

              <div class="form-group">
                <textarea class="form-control" id="post" name="admin_bio" rows="8" cols="80" placeholder="Bio"></textarea>
              </div>

              <div class="form-group">
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="image_upload" id="image_select" value="">
                  <label for="image_select" class="custom-file-label">Select image</label>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <a href="admin.php?a=dashboard" class="btn btn-light btn-sm border">
                    <span class="align-sub"><i class="fas fa-arrow-left"></i> Back to dashboard</span>
                  </a>
                  <button type="submit" name="Submit" class="btn btn-success btn-sm float-right">
                    <span class="align-sub"><i class="fas fa-check"></i> Publish</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- Main part - END -->
  ';
?>
