<?php
  $merged_title = 'Admins';
  $merged_content .= '

  <!-- Header -->
  <header class="py-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h6><i class="fas fa-user text-success"></i> Manage admins</h6>
        </div>
      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="">
        <form class="" action="admin_private.php?a=admins_function" method="post">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Add new admin</h5>
            </div>
            <div class="card-body">
              <!-- Username -->
              <div class="form-group">
                <label for="username" class="m-0"><span class="fieldInfo">Username:</span></label>
                <input class="form-control" type="text" name="Username" id="username" placeholder="Type username here" value="">
              </div>
              <!-- Name -->
              <div class="form-group">
                <label for="name" class="m-0"><span class="fieldInfo">Name:</span></label>
                <span class="fieldInfo_2 text-muted float-right pt-1">(This is optional)</span>
                <input class="form-control" type="text" name="Name" id="name" placeholder="Type name here" value="">
              </div>
              <!-- Password -->
              <div class="form-group">
                <label for="password" class="m-0"><span class="fieldInfo">Password:</span></label>
                <input class="form-control" type="password" name="Password" id="password" value="">
              </div>
              <!-- Confirm password -->
              <div class="form-group">
                <label for="confirm_password" class="m-0"><span class="fieldInfo">Confirm password:</span></label>
                <input class="form-control" type="password" name="Confirm_password" id="confirm_password" value="">
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <a href="admin_private.php?a=dashboard" class="btn btn-light btn-sm border">
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

  <!-- Delete existing admins -->
  <section class="container-fluid py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <h5><i class="fas fa-user-slash text-success"></i> Delete existing admin</h5>
        <div class="card">
          <table class="table table-sm" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th class="text-right w_005">#</th>
                <th class="w_015">Date</th>
                <th class="w_025">Username</th>
                <th class="w_025">Admin name</th>
                <th class="w_025">Added by</th>
                <th class="text-center w_005">Action</th>
              </tr>
            </thead>
            <tbody>
            ';
              global $connecting_db;
              $sql = "SELECT * FROM admins ORDER BY id desc";
              $execute = $connecting_db->query($sql);
              $sr_no = 0;

              while ($data_rows = $execute->fetch()) {
                $admin_id       = $data_rows["id"];
                $admin_date     = $data_rows["datetime"];
                $admin_username = $data_rows["username"];
                $admin_name     = $data_rows["admin_name"];
                $added_by       = $data_rows["added_by"];
                $admin_image    = $data_rows["admin_image"];
                $sr_no++;
            $merged_content .= '
            <tr>
              <td class="text-right font-weight-bold w_005"><b>'. htmlentities($sr_no) .'.</b></td>
              <td class="text-muted w_015">'. htmlentities($admin_date) .'</td>
              <td class="font-weight-bold w_025"><a href="profile_public.php?username='. htmlentities($admin_username) .'" target="_blank" title="Public profile">'. htmlentities($admin_username) .'</a></td>
              <td class="text-muted w_025">'. htmlentities($admin_name) .'</td>
              <td class="text-muted w_025">'. htmlentities($added_by) .'</td>
              <td class="text-center w_005">
                <a href="admin_private.php?a=admin_delete&id='. $admin_id .'" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
  <!-- Delete existing admins - END -->
  <!-- Main part - END -->
  ';
?>
