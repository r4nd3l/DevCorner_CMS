<?php
  $merged_title = 'Comments';
  $merged_content .= '
  <section class="container-fluid py-2 mb-4">
  <div class="row">
    <div class="col-lg-12">
          <!-- Unapproved table -->
          <h5><i class="far fa-clock text-success"></i> Unapproved comments</h5>
          <div class="card">
            <table class="table table-sm" style="margin-bottom: 0;">
              <thead class="thead-light">
                <tr>
                  <th class="text-truncate text-right mw_005">#</th>
                  <th class="text-truncate mw_020" >Date</th>
                  <th class="text-truncate mw_020">Name</th>
                  <th class="text-truncate mw_045">Comment</th>
                  <th class="text-truncate text-center mw_010">Action</th>
                </tr>
              </thead>
              <tbody>
              ';
                global $connecting_db;
                $sql = "SELECT * FROM comments WHERE status=0 ORDER BY id desc";
                $execute = $connecting_db->query($sql);
                $sr_no = 0;

                while ($data_rows = $execute->fetch()) {
                  $comment_id           = $data_rows["id"];
                  $datetime_of_comments = $data_rows["datetime"];
                  $commenter_name       = $data_rows["name"];
                  $comment_content      = $data_rows["comment"];
                  $comment_post_id      = $data_rows["post_id"];
                  $sr_no++;

              $merged_content .= '
              <tr>
                <td class="text-truncate text-success text-right font-weight-bold mw_005">'.htmlentities($sr_no).'.</td>
                <td class="text-truncate text-muted mw_020">'.htmlentities($datetime_of_comments).'</td>
                <td class="text-truncate text-muted font-weight-bold w_020">'.htmlentities($commenter_name).'</td>
                <td class="text-truncate w_045"><a href="post_full.php?id='.$comment_post_id.'" title="View" target="_blank">'.htmlentities($comment_content).'</a></td>
                <td class="text-center mw_010">
                  <a href="admin_private.php?a=approve_comment&id='.$comment_id.'" title="Approve"><i class="far fa-check-circle"></i></a>
                  <a href="admin_private.php?a=comment_delete&id='.$comment_id.'" title="Delete"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              ';
              }
              $merged_content .= '
              </tbody>
            </table>
          </div>
          <!-- Unapproved table - END -->
        </div>
      </div>
    </section>

    <section class="container-fluid py-2 mb-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Disapprove table -->
          <h5><i class="fas fa-history text-success"></i> Disapprove comments</h5>
          <div class="card">
            <table class="table table-sm" style="margin-bottom: 0;">
              <thead class="thead-light">
                <tr>
                  <th class="text-truncate text-right mw_005">#</th>
                  <th class="text-truncate mw_020" >Date</th>
                  <th class="text-truncate mw_020">Name</th>
                  <th class="text-truncate mw_045">Comment</th>
                  <th class="text-truncate text-center mw_010">Action</th>
                </tr>
              </thead>
              ';
                global $connecting_db;
                $sql = "SELECT * FROM comments WHERE status=1 ORDER BY id desc";
                $execute = $connecting_db->query($sql);
                $sr_no = 0;

                while ($data_rows = $execute->fetch()) {
                  $comment_id           = $data_rows["id"];
                  $datetime_of_comments = $data_rows["datetime"];
                  $commenter_name       = $data_rows["name"];
                  $comment_content      = $data_rows["comment"];
                  $comment_post_id      = $data_rows["post_id"];
                  $sr_no++;

              $merged_content .= '
              <tbody>
                <tr>
                  <td class="text-truncate text-success text-right font-weight-bold mw_005">'.htmlentities($sr_no).'.</td>
                  <td class="text-truncate text-muted mw_020">'.htmlentities($datetime_of_comments).'</td>
                  <td class="text-truncate text-muted font-weight-bold w_020">'.htmlentities($commenter_name).'</td>
                  <td class="text-truncate w_045"><a href="post_full.php?id='.$comment_post_id.'" title="View" target="_blank">'.htmlentities($comment_content).'</a></td>
                  <td class="text-center mw_010">
                    <a href="admin_private.php?a=approve_comment&id='.$comment_id.'" title="Dispprove"><i class="fas fa-undo"></i></a>
                    <a href="admin_private.php?a=comment_delete&id='.$comment_id.'" title="Delete"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              </tbody>
              ';
              }
              $merged_content .= '
            </table>
          </div>
          <!-- Disapprove table - END -->
        </div>
      </div>
    </section>
  <!-- Main part - END -->
  ';
?>
