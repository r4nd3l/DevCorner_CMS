<?php require_once("includes/db.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- DevCorner - Favicon -->
  <link rel="shortcut icon" href="img/favicon.svg"/>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico"/>

  <!-- Font-Awesome v5.8.2 -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

  <!-- Bootstrap 4.3 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Custom Style -->
  <link rel="stylesheet" href="css/styles.css">

  <title>Posts</title>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">

      <!-- Logo part -->
      <a href="" class="navbar-brand"><i class="fas fa-code text-success"></i> DevCorner</a>

      <!-- The button for "Collapsable munu" -->
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_collapse_CMS">
        <span class="navbar-toggler-icon text-white"></span>
      </button>

      <!-- Collapsable menu -->
      <div class="collapse navbar-collapse" id="navbar_collapse_CMS">
        <!-- Menu part -->
        <ul class="navbar-nav m-auto">
          <li class="nav-item"><a href="myProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a></li>
          <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
          <li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
          <li class="nav-item"><a href="admins.php" class="nav-link">Manage Admins</a></li>
          <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
          <li class="nav-item"><a href="blog.php?page=1" class="nav-link">Live Blog</a></li>
        </ul>

        <!-- Login/out part -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="logout.php" class="btn btn-light btn-sm nav-link">
              <span class="align-sub"><i class="fas fa-sign-out-alt"></i> Logout</span>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- Navbar - END -->

  <!-- Header -->
  <header class="py-3">
    <div class="container">
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
          <a href="comments.php" class="btn btn-outline-success btn-sm btn-block">
            <span class="align-sub"><i class="fas fa-check"></i> Approve comment</span>
          </a>
        </div>

      </div>
    </div>
  </header>
  <!-- Header - END -->

  <!-- Main part -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Data & Time</th>
                <th>Author</th>
                <th>Banner</th>
                <th>Comments</th>
                <th>Action</th>
                <th>Preview</th>
              </tr>
            </thead>
            <?php
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
            ?>
            <tbody>
              <tr>
                <td><?php echo $sr; ?>.</td>
                <td class="table-success"><?php echo $post_title; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $datetime; ?></td>
                <td class="table-secondary"><?php echo $admin; ?></td>
                <td><img src="uploads/<?php echo $image; ?>" width="170px;"></td>
                <td>Comments</td>
                <td class="text-center">
                  <a href="#" title="Edit"><i class="fas fa-edit"></i></a>
                  <a href="#" title="Delete"><i class="fas fa-trash-alt"></i></a>
                </td>
                <td class="text-center"><a href="#" title="Live preview"><i class="fas fa-glasses"></i></a></td>
              </tr>
            </tbody>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- Main part - END -->

  <!-- Footer part -->
  <footer class="bg-light border-top fixed-bottom">
    <div class="container">
      <div class="row m-3">
        <div class="col">
          <p class="lead text-center">Theme by DevCorner - <span id="year"></span></p>
          <p class="text-center small">
            This site is only used for a case-study of <br>
            <a href="https://github.com/r4nd3l"><i class="fas fa-code text-success" style="cursor: pointer; text-decoration: none;"></i> DevCorner Community</a> -
            The independent web developer community
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer part - END -->


  <!-- CDNs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- Custom scripts -->
  <script type="text/javascript">$('#year').text(new Date().getFullYear());</script>

</body>
</html>
