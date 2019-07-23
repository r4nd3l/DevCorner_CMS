<?php
  // $merged_title = 'Posts';
  // $recent_icon = '<i class="fas fa-file-alt text-success"></i>';
  $merged_content .= '

  <div id="sec_posts" class="border mb-3 rounded shadow mr-3">
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-edit text-success"></i> Posts section</h6>
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
  <section class="container-fluid p-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-truncate text-right mw_005">#</th>
                <th class="text-truncate mw_025">Title</th>
                <th class="text-truncate mw_010">Category</th>
                <th class="text-truncate mw_015">Date</th>
                <th class="text-truncate mw_010">Author</th>
                <th class="text-truncate mw_015">Banner</th>
                <th class="text-truncate text-center mw_015">Comments</th>
                <th class="text-truncate text-center mw_005">Action</th>
              </tr>
            </thead>
            <tbody>
            ';
              global $connecting_db;
              $sql = "SELECT * FROM posts";
              $sql = "SELECT p.*, c.title as category_title FROM posts p left join category c on (c.id=p.category_id) order by id desc";
              $stmt = $connecting_db->query($sql);
              $sr = 0;

              while ($data_rows = $stmt->fetch()) {
                $id               = $data_rows["id"];
                $datetime         = $data_rows["datetime"];
                $post_title       = $data_rows["title"];
                $category         = $data_rows["category_title"];
                $admin            = $data_rows["author"];
                $image            = $data_rows["image"];
                $post_description = $data_rows["post"];
                $sr++;
              $merged_content .= '

              <!-- Image preloader with CSS -->
              <img src="uploads/'.$image.'" style="display: none;">

            <tr>
              <td class="text-right text-success font-weight-bold mw_005">'.$sr.'.</td>
              <td class="text-truncate mw_025"><a href="post_full.php?id='.$id.'" target="_blank" title="View">'.$post_title.'</a></td>
              <td class="text-truncate font-weight-bold mw_010"><a href="blog.php?category='.$category.'" target="_blank" title="View all">'.$category.'</a></td>
              <td class="text-truncate text-muted mw_015">'.$datetime.'</td>
              <td class="text-truncate font-weight-bold mw_010">
                <!-- Modal will goes here -->
                <a href="profile_public.php?username='.htmlentities($admin).'" target="_blank"> '.htmlentities($admin).' </a>
              </td>
              <td class="text-truncate mw_015">
                <!-- Modal will goes here -->
                <span tabindex="0" class="text-success pointer" data-toggle="popover" data-content="<img width=\'150\' src=\'uploads/'.$image.'\'>">'.basename($image).'</span>
              </td>
              <td class="text-truncate text-center mw_015 mouse_default p-1">
                <span class="text-success" title="Unapproved"><i class="fas fa-clock"></i> '. comment_disapprove($id).'</span>
                <hr class="m-0">
                <span class="badge text-secondary" title="Approved"><i class="fas fa-check-circle"></i> '.  comment_approve($id) .'</span>
              </td>
              <td class="text-center mw_005">

                <a href="#editPost-id='.$id.'" title="Edit" data-toggle="modal" data-target="#editPostModal" data-postid="'.$id.'" data-modaltitle="'.htmlentities($post_title).'"><i class="fas fa-edit"></i></a>
                <a href="#deletePost-id='.$id.'" title="Delete" data-toggle="modal" data-target="#deletePostModal" data-postid="'.$id.'" data-modaltitle="'.htmlentities($post_title).'"><i class="fas fa-trash-alt"></i>
                </td>
              </tr>
              ';
            }
            $merged_content .= '
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- Main part - END -->

  <!-- Modal for Edit posts -->
  <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog content_modal" role="document">
      <div class="modal-content">
        <div class="modal-header py-1">
          <h6 class="mb-0 mt-1">Editing now - <span class="text-muted" id="modalTitle"></span></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body content_modal_body p-0">
            <iframe id="editPostIframe" class="posts_iframe" src="" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal for edit posts - END -->

  <!-- Modal for Delete posts -->
  <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog content_modal" role="document">
      <div class="modal-content">
        <div class="modal-header py-1">
          <h6 class="mb-0 mt-1">Editing now - <span class="text-muted" id="modalTitle"></span></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body content_modal_body p-0">
            <iframe id="deletePostIframe" class="posts_iframe" src="" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal for Delete posts - END -->
  </div>
';
?>
