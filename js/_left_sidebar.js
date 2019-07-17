// Sidebar function
// $('.toggle-sidebar').click(function(){
//   $('#contentBar').hide();
// });

// $('.toggle-sidebar').click(function(){
//   $('#sideBar').toggleClass('col-lg-2 col-lg-1');
//   $('#contentBar').toggleClass('col-lg-10 col-lg-11');
// });
//

function openSideBar() {
  document.getElementById("sideBar").style.width = "200px";
  document.getElementById("contentBar").style.marginLeft = "200px";
}

function closeSideBar() {
  document.getElementById("sideBar").style.width = "42px";
  document.getElementById("contentBar").style.marginLeft= "42px";
}
