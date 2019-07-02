// Modal settings
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
