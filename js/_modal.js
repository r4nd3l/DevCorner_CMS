// Modal settings

// Edit posts
$(document).ready(function() {
    $('#editPostModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var post_id = button.data('postid'); // Extract info from data-* attributes
      var post_title = button.data('modaltitle');
      var modal = $(this);
      var src = 'post_edit.php?id=' + post_id;
      $("#editPostModal #modalTitle").text(post_title);
      modal.find('#editPostIframe').attr('src', src);
    });
});

// Delete posts
$(document).ready(function() {
    $('#deletePostModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var post_id = button.data('postid'); // Extract info from data-* attributes
      var post_title = button.data('modaltitle');
      var modal = $(this);
      var src = 'post_delete.php?id=' + post_id;
      $("#deletePostModal #modalTitle").text(post_title);
      modal.find('#deletePostIframe').attr('src', src);
    });
});
