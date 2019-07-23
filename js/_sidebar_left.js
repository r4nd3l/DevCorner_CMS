$(document).ready(function($){
  $('#toggle-sideBar').on('click',function(){
    if($(this).attr('data-click-state') == 1) {
      $(this).attr('data-click-state', 0);
      $("#sideBar").css({width: "45px"});
      $("#contentBar").css({marginLeft: "45px"});
      $("._tip").css({visibility: "visible"});
    } else {
      $(this).attr('data-click-state', 1)
      $("#sideBar").css({width: "200px"});
      $("#contentBar").css({marginLeft: "200px"});
      $("._tip").css({visibility: "hidden"});
    }
    $('.fa-window-maximize').toggleClass('fas far');
  });
});
