<?php
  $merged_title = 'Add post';
  $merged_content .= '

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-edit text-success"></i> Manage post</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <form class="" action="admin.php?a=post_add_function" method="post" enctype="multipart/form-data">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new post</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Post title:</span></label>
                <input class="form-control" type="text" name="post_title" id="title" placeholder="Type title here" value="">
              </div>
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Chose category:</span></label>
                <select id="category_title" class="form-control" name="category">
                  ';
                    // Fetching all the categories from category table
                    global $connecting_db;
                    $sql = "SELECT id,title FROM category";
                    $stmt = $connecting_db->query($sql);
                    while($data_rows = $stmt->fetch()){
                      $id = $data_rows["id"];
                      $category_name = $data_rows["title"];
                  $merged_content .= '
                    <option>'. $category_name .'</option>
                    ';
                  }
                  $merged_content .= '
                </select>
              </div>
              <div class="form-group">
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="image_upload" id="image_select" value="">
                  <label for="image_select" class="custom-file-label">Select image</label>
                </div>
              </div>
              <div class="form-group">
                <label for="post"><span class="fieldInfo">Post:</span></label>
                <textarea class="form-control" id="post" name="post_description" rows="8" cols="80"></textarea>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="dashboard.php" class="btn btn-light btn-sm border">
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
