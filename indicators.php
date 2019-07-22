<?php
  $merged_title = 'Indicators';
  $recent_icon = '<i class="fas fa-tachometer-alt text-success"></i>';
  $merged_content .= '

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">

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
        <div class="card text-center text-success border-0 mb-3">
          <div class="crad-body">
            <div class="c100 p'. pct_posts() .' small bg-grayish">
              <span class="text-success">'. pct_posts() .'%</span>
              <div class="slice">
                <div class="bar border-success"></div>
                <div class="fill"></div>
              </div>
            </div>
            <h5 class="m-0"><i class="fab fa-readme"></i><br> '. total_posts() .'</h5>
            <h6 class="">Posts</h6>
          </div>
        </div>

        <div class="card text-center text-success border-0 mb-3">
          <div class="crad-body">
            <div class="c100 p'. pct_categories() .' small bg-grayish">
              <span class="text-success">'. pct_categories() .'%</span>
              <div class="slice">
                <div class="bar border-success"></div>
                <div class="fill"></div>
              </div>
            </div>
            <h5 class="m-0"><i class="fas fa-inbox"></i><br> '. total_categories() .'</h5>
            <h6 class="">Categories</h6>
          </div>
        </div>

        <div class="card text-center text-success border-0 mb-3">
          <div class="crad-body">
            <div class="c100 p'. pct_admins() .' small bg-grayish">
              <span class="text-success">'. pct_admins() .'%</span>
              <div class="slice">
                <div class="bar border-success"></div>
                <div class="fill"></div>
              </div>
            </div>
            <h5 class="m-0"><i class="fas fa-users"></i><br> '. total_admins() .'</h5>
            <h6 class="">Admins</h6>
          </div>
        </div>

        <div class="card text-center text-success border-0 mb-3">
          <div class="crad-body">
            <div class="c100 p'. pct_comments() .' small bg-grayish">
              <span class="text-success">'. pct_comments() .'%</span>
              <div class="slice">
                <div class="bar border-success"></div>
                <div class="fill"></div>
              </div>
            </div>
            <h5 class="m-0"><i class="fas fa-comments"></i><br> '. total_comments() .'</h5>
            <h6 class="">Comments</h6>
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
                <th class="text-truncate text-right mw_005">#</th>
                <th class="text-truncate mw_035">Title</th>
                <th class="text-truncate mw_020">Date</th>
                <th class="text-truncate mw_020">Author</th>
                <th class="text-truncate text-center mw_020">Comments</th>
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
                <td class="text-truncate text-right text-success font-weight-bold mw_005">'.$sr_no.'.</td>
                <td class="text-truncate mw_035"><a href="post_full.php?id='.$post_id.'" title="View" target="_blank">'.$title.'</a></td>
                <td class="text-truncate text-muted mw_020">'.$datetime.'</td>
                <td class="text-truncate font-weight-bold mw_020"><a href="profile_public.php?username='.htmlentities($author).'" target="_blank" title="Public profile">'.$author.'</a></td>
                <td class="text-center mw_020 mouse_default p-1">
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
