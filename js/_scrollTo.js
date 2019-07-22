// Default DevCorner JavaScript Setting
$(document).ready(function(){
  $(window).scroll(function(){
    if($(this).scrollTop() > 40){
      $('#topBtn').fadeIn();
    } else{
      $('#topBtn').fadeOut();
    }
  });

  // scroll to the top
  $("#topBtn").click(function(){
    $('html ,body').animate({scrollTop : 0},500);
  });

  // scroll to each section
  $('.scroll_to_section').click(function(){
    $('html, body').animate({
      scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
  });
});
