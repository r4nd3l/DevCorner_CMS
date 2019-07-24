<?php
  // $merged_title = 'Indicators';
  // $recent_icon = '<i class="fas fa-tachometer-alt text-success"></i>';
  $merged_content .= '

<div id="sec_indicators">
  <div class="border mb-3 rounded shadow mr-3">
    <!-- Header -->
    <header class="line_left py-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <h6 class="m-0"><i class="fas fa-tachometer-alt text-success"></i> Indicators section</h6>
          </div>
        </div>
      </div>
    </header>
    <!-- Header - END -->
  </div>

  <!-- Main part -->
  <section class="container-fluid p-3">
    <div class="row">

      <!-- Left side area -->
      <div class="col-lg-12">
        <div class="row">

          <div class="col-lg-6">
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>File overview box - list of uploaded files/images</p>
              </div>
            </div>
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>Calendar overview box - days of posted contents</p>
              </div>
            </div>
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>Drag\'n\'drop box - quick upload</p>
              </div>
            </div>
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>Gallery box - image library</p>
              </div>
            </div>
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>Time graph based on the dates/calendar</p>
              </div>
            </div>
            <div class="card text-center text-success border mb-2">
              <div class="crad-body">
                <p>Dragable ToDo list(?)</p>
              </div>
            </div>
          </div>

          <!-- Indicator boxes - END -->
          <div class="col-lg-6">
            <div class="col-lg-12">
              <div class="row">

                <div class="col-lg-6 pb-3 pr-0">
                <div class="line_header">Posts</div>
                  <div class="line_bottom line_sharp_top card m-1 p-0 shadow text-center text-success">
                      <div class="crad-body m_x">
                        <div class="c100 p'. pct_posts() .' small bg-grayish mt-2">
                          <span class="text-success">'. pct_posts() .'%</span>
                          <div class="slice">
                            <div class="bar border-success"></div>
                            <div class="fill"></div>
                          </div>
                        </div>
                      </div>
                    <div class="line_bar">
                      <div class="line_stat m-0">In total - '. total_posts() .'</div>
                      <div class="line_icon"><i class="fas fa-file-alt fa-fw"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 pb-3 pr-0">
                <div class="line_header">Categories</div>
                  <div class="line_bottom line_sharp_top card m-1 p-0 shadow text-center text-success">
                      <div class="crad-body m_x">
                        <div class="c100 p'. pct_categories() .' small bg-grayish mt-2">
                          <span class="text-success">'. pct_categories() .'%</span>
                          <div class="slice">
                            <div class="bar border-success"></div>
                            <div class="fill"></div>
                          </div>
                        </div>
                      </div>
                    <div class="line_bar">
                      <div class="line_stat m-0">In total - '. total_categories() .'</div>
                      <div class="line_icon"><i class="fas fa-inbox fa-fw"></i></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-12">
              <div class="row">

                <div class="col-lg-6 pb-3 pr-0">
                <div class="line_header">Admins</div>
                  <div class="line_bottom line_sharp_top card m-1 p-0 shadow text-center text-success">
                      <div class="crad-body m_x">
                        <div class="c100 p'. pct_admins() .' small bg-grayish mt-2">
                          <span class="text-success">'. pct_admins() .'%</span>
                          <div class="slice">
                            <div class="bar border-success"></div>
                            <div class="fill"></div>
                          </div>
                        </div>
                      </div>
                    <div class="line_bar">
                      <div class="line_stat m-0">In total - '. total_admins() .'</div>
                      <div class="line_icon"><i class="fas fa-users fa-fw"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 pb-3 pr-0">
                <div class="line_header">Comments</div>
                  <div class="line_bottom line_sharp_top card m-1 p-0 shadow text-center text-success">
                      <div class="crad-body m_x">
                        <div class="c100 p'. pct_comments() .' small bg-grayish mt-2">
                          <span class="text-success">'. pct_comments() .'%</span>
                          <div class="slice">
                            <div class="bar border-success"></div>
                            <div class="fill"></div>
                          </div>
                        </div>
                      </div>
                    <div class="line_bar">
                      <div class="line_stat m-0">In total - '. total_comments() .'</div>
                      <div class="line_icon"><i class="fas fa-comments fa-fw"></i></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- Indicator boxes - END -->

        </div>
      </div>
      <!-- Left side area - END -->

      <!-- Right side area -->
      <div class="col-lg-12">
        <h6><i class="fas fa-file-alt text-success"></i> Recent posts</h6>
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
</div>
  ';
?>
