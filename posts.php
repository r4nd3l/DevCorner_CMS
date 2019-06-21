<?php

$TITLE = 'Posts';

$TARTALOM .= '
<header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-edit text-success"></i> Manage blog posts</h6>
        </div>

        <div class="col-lg-3 mb-2">
          <!-- Add new post -->
          <a href="add_new_post.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-file-alt"></i> Add new post</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new category -->
          <a href="categories.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-folder-plus"></i> Add new category</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Add new admin -->
          <a href="admins.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-user-plus"></i> Add new admin</span>
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <!-- Approve comment -->
          <a href="admin.php?a=comments" class="btn btn-outline-success btn-sm btn-block">
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
      <div class="col-lg-12">
        <div class="card">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-right">#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Comments</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
';
              global $connecting_db;
              $sql = "SELECT * FROM posts";
              $stmt = $connecting_db->query($sql);
              $sr = 0;

              while ($data_rows = $stmt->fetch()) {
                $id               = $data_rows["id"];
                $datetime         = $data_rows["datetime"];
                $post_title       = $data_rows["title"];
                $category         = $data_rows["category"];
                $admin            = $data_rows["author"];
                $image            = $data_rows["image"];
                $post_description = $data_rows["post"];
                $sr++;
$TARTALOM .= '
            <tr>
              <td class="text-right font-weight-bold w_005">'.$sr.'.</td>
              <td class="w_035"><a href="full_post.php?id='.$id.'" target="_blank" title="View">'.$post_title.'</a></td>
              <td class="font-weight-bold w_010"><a href="blog.php?category='.$category.'" target="_blank" title="View all">'.$category.'</a></td>
              <td class="text-muted w_015">'.$datetime.'</td>
              <td class="font-weight-bold w_010">
                <!-- Modal will goes here -->
                <a href="profile.php?username='.htmlentities($admin).'" target="_blank" title="Public profile">'.htmlentities($admin).'</a>
              </td>
              <td class="_w015">
                <!-- Modal will goes here -->
                <div class="img_tooltip_posts">
                  <p>'.basename($image).'</p>
                  <div class="content">
                    <img src="uploads/'.$image.'">
                  </div>
                </div>
              </td>
              <td class="text-center w_005 mouse_default p-1">
                <span class="text-success" title="Unapproved"><i class="fas fa-clock"></i> '. disapprove_comment($id).'</span>
                <hr class="m-0">
                <span class="badge text-secondary" title="Approved"><i class="fas fa-check-circle"></i> '. approve_comment($id) .'</span>
              </td>
              <td class="text-center w_005">

                <!-- Modal for posts-->
                <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editPostModalLabel">Edit posts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <iframe id="editPostIframe" class="posts_iframe" src="" frameborder="0"></iframe>
                      </div>
                    </div>
                  </div>
                </div>

                <a href="#editPost-id='.$id.'" title="Edit" data-toggle="modal" data-target="#editPostModal" data-postid="'.$id.'"><i class="fas fa-edit"></i></a>
                <a href="delete_post.php?id='.$id.'" title="Delete"><i class="fas fa-trash-alt"></i>
                </td>
              </tr>
              ';
            }
            $TARTALOM .= '
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- Main part - END -->
';

?>
