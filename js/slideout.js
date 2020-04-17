jQuery(function ($) {

//     $(".sidebar-dropdown > a").click(function() {
//   $(".sidebar-submenu").slideUp(200);
//   if (
//     $(this)
//       .parent()
//       .hasClass("active")
//   ) {
//     $(".sidebar-dropdown").removeClass("active");
//     $(this)
//       .parent()
//       .removeClass("active");
//   } else {
//     $(".sidebar-dropdown").removeClass("active");
//     $(this)
//       .next(".sidebar-submenu")
//       .slideDown(200);
//     $(this)
//       .parent()
//       .addClass("active");
//   }
// });

  $("#toggle-sidebar").click(function() {
      $('.page-wrapper').toggleClass('toggled');
  });

  $("#toggle-sidebar-right").click(function() {
    $('.page-wrapper').toggleClass('toggled-right');
  });

function mobileAutoToggle(x) {
    if (x.matches) { // If media query matches
      $(".page-wrapper").removeClass("toggled-right");
      $(".page-wrapper").removeClass("toggled");
    } else {
      $(".page-wrapper").addClass("toggled-right");
      $(".page-wrapper").addClass("toggled");
    }
  }
  var x = window.matchMedia("(max-width: 575.98px)")
  mobileAutoToggle(x) // Call listener function at run time
  x.addListener(mobileAutoToggle) // Attach listener function on state changes

});