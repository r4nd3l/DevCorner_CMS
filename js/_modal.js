/*
// Get the modal
var modal = document.getElementById("myModal_").getAttribute('data-modal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn_").getAttribute('data-btn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("_close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
*/

// fly code comes here:

$(document).ready(function() {
    $('#editPostModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var post_id = button.data('postid'); // Extract info from data-* attributes
      var modal = $(this);
      var src = 'edit_post.php?id=' + post_id;
      console.log(src);
      modal.find('#editPostIframe').attr('src', src);
    });
});
