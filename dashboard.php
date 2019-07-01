<?php
  $merged_title = 'Dashboard';
  $merged_content .= '

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-cog text-success"></i> Dashboard</h6>
        </div>

        <div class="col-lg-3 mb-2">
          <!-- Add new post -->
          <a href="admin_private.php?a=post_add" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-file-alt"></i> Add new post</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new category -->
          <a href="admin_private.php?a=categories" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-folder-plus"></i> Add new category</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new admin -->
          <a href="admin_private.php?a=admins" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-user-plus"></i> Add new admin</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Approve comment -->
          <a href="admin_private.php?a=comments" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-check"></i> Approve comment</span>
          </a>
        </div>

      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">

      <!-- Left side area -->
      <div class="col-lg-2">
        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Posts</h6>
            <h5 class=""><i class="fab fa-readme"></i> '. total_posts() .'</h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Categories</h6>
            <h5 class=""><i class="fas fa-inbox"></i> '. total_categories() .'</h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Admins</h6>
            <h5 class=""><i class="fas fa-users"></i> '. total_admins() .'</h5>
          </div>
        </div>

        <div class="card text-center text-success border-success mb-3">
          <div class="crad-body">
            <h6 class="my-2">Comments</h6>
            <h5 class=""><i class="fas fa-comments"></i> '. total_comments() .'</h5>
          </div>
        </div>
      </div>
      <!-- Left side area - END -->

      <!-- Right side area -->
      <div class="col-lg-10">
        <h5><i class="fab fa-readme text-success"></i> Top posts</h5>
        <div class="card">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-right w_005">#</th>
                <th class="w_050">Title</th>
                <th class="w_020">Date</th>
                <th class="w_020">Author</th>
                <th class="text-center w_005">Comments</th>
              </tr>
            </thead>
            <tbody>
            ';
              $sr_no = 0;
              global $connecting_db;
              $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt = $connecting_db->query($sql);

              while ($data_rows = $stmt->fetch()) {
                $post_id  = $data_rows["id"];
                $datetime = $data_rows["datetime"];
                $author   = $data_rows["author"];
                $title    = $data_rows["title"];
                $sr_no++;
            $merged_content .= '
              <tr>
                <td class="text-right text-success font-weight-bold w_005">'.$sr_no.'.</td>
                <td class="w_050"><a href="post_full.php?id='.$post_id.'" title="View" target="_blank">'.$title.'</a></td>
                <td class="text-muted w_020">'.$datetime.'</td>
                <td class="font-weight-bold w_020"><a href="profile_public.php?username='.htmlentities($author).'" target="_blank" title="Public profile">'.$author.'</a></td>
                <td class="text-center w_005 mouse_default p-1">
                  <span class="text-success" title="Unapproved"><i class="fas fa-clock"></i> '.comment_disapprove($post_id).'</span>
                  <hr class="m-0">
                  <span class="badge text-secondary" title="Approved"><i class="fas fa-check-circle"></i> '.comment_approve($post_id).'</span>
                </td>
              </tr>
              ';
            }
            $merged_content .= '
            </tbody>
          </table>
        </div>
      </div>
      <!-- Right side area - END -->
    </div>
  </section>
  <!-- Main part - END -->
  ';
?>
