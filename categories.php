<?php
  // $merged_title = 'Categories';
  // $recent_icon = '<i class="fas fa-folder-plus text-success"></i>';
  $merged_content .= '

  <div id="sec_categories" class="border mb-3 rounded shadow mr-3">
  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-folder-plus text-success"></i> Categories section</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <!-- Add new category -->
  <section class="container-fluid p-3">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <form class="" action="admin_private.php?a=category_add" method="post">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new category</h5>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="title"><span class="fieldInfo">Category title:</span></label>
                <input class="form-control" type="text" name="category_title" id="title" placeholder="Type title here" value="">
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="admin_private.php?a=indicators" class="btn btn-light btn-sm border">
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
  <!-- Add new category - END -->

  <!-- Delete existing category -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <h6><i class="fas fa-inbox text-success"></i> Existing categories</h6>
        <div class="card">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-truncate text-right mw_005">#</th>
                <th class="text-truncate mw_015">Date</th>
                <th class="text-truncate mw_020">Category</th>
                <th class="text-truncate mw_055">Creator</th>
                <th class="text-truncate text-center mw_005">Action</th>
              </tr>
            </thead>
            <tbody>
            ';
              global $connecting_db;
              $sql = "SELECT * FROM category ORDER BY id desc";
              $execute = $connecting_db->query($sql);
              $sr_no = 0;

              while ($data_rows = $execute->fetch()) {
                $category_id   = $data_rows["id"];
                $category_date = $data_rows["datetime"];
                $category_name = $data_rows["title"];
                $creator_name  = $data_rows["author"];
                $sr_no++;
            $merged_content .= '
            <tr>
              <td class="text-truncate text-right text-success font-weight-bold mw_005"><b>'. htmlentities($sr_no) .'.</b></td>
              <td class="text-truncate text-muted mw_015">'. htmlentities($category_date) .'</td>
              <td class="text-truncate font-weight-bold mw_020"><a href="blog.php?category='. $category_name .'" target="_blank" title="View all">'. htmlentities($category_name) .'</a></td>
              <td class="text-truncate mw_030"><a href="profile_public.php?username='. htmlentities($creator_name) .'" target="_blank" title="Public profile">'. htmlentities($creator_name) .'</a></td>
              <td class="text-center mw_030">
                <a href="admin_private.php?a=category_delete&id='. $category_id .'" title="Delete"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
            ';
            }
            $merged_content .= '
            </tbody>
          </table>
        </div>
        <!--  - END -->

      </div>
    </div>
  </section>
  <!-- Delete existing category - END -->
  <!-- Main part - END -->
  </div>
  ';
?>
