<ul>
  <li><a href="javascript:void(0)" id="toggle-sideBar"><i class="fas fa-window-maximize fa-rotate-270 fa-fw mr-3 mt-1"></i> <span>Minimize</span></a></li>
  <li><a href="admin_private.php?a=dashboard" class="_tool"><i class="fas fa-home fa-fw mr-3 mt-1"></i> <span>Dashboard</span></a><span class="_tip">Dashboard</span></li>
  <li><a href="admin_private.php?a=profile_private" class="_tool"><i class="far fa-address-card fa-fw mr-3 mt-1"></i> <span>Profile</span></a><span class="_tip">Profile</span></li>
  <li><a href="#sec_indicators" class="_tool scroll_to_section"><i class="fas fa-tachometer-alt fa-fw mr-3 mt-1"></i> <span>Indicators</span></a><span class="_tip">Indicators</span></li>
  <li><a href="#sec_posts" class="_tool scroll_to_section"><i class="fas fa-file-alt fa-fw mr-3 mt-1"></i> <span>Posts</span><small><?php echo total_posts(); ?></small></a><span class="_tip">Posts</span></li>
  <li><a href="#sec_categories" class="_tool scroll_to_section"><i class="fas fa-folder-plus fa-fw mr-3 mt-1"></i> <span>Categories</span><small><?php echo total_categories(); ?></small></a><span class="_tip">Categories</span></li>
  <li><a href="#sec_admins" class="_tool scroll_to_section"><i class="fas fa-users fa-fw mr-3 mt-1"></i> <span>Admins</span><small><?php echo total_admins(); ?></small></a><span class="_tip">Admins</span></li>
  <li><a href="#sec_comments" class="_tool scroll_to_section"><i class="fas fa-comments fa-fw mr-3 mt-1"></i> <span>Comments</span><small><?php echo total_comments(); ?></small></a><span class="_tip">Comments</span></li>
  <hr>
  <li><a href="blog.php?page=1" class="_tool" target="_blank"><i class="fas fa-book fa-fw mr-3 mt-1"></i> <span>Visit the blog</span></a><span class="_tip">LiveBlog</span></li>
  <li><a href="logout.php" class="_tool"><i class="fas fa-power-off fa-fw mr-3 mt-1"></i> <span>Logout</span></a><span class="_tip">Logout</span></li>
</ul>
