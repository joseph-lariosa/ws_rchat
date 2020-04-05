jQuery(function ($) {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#toggle-sidebar").click(function() {
    $('.page-wrapper').toggleClass('toggled');
});


  $("#toggle-sidebar-right").click(function() {
    $('.page-wrapper').toggleClass('toggled-right');
  });


function mobileToggleSolo(y){
  if (y.matches) { // If media query matches
    $("#toggle-sidebar-right").click(function() {
      $('.page-wrapper').toggleClass('toggled-right');
    });

    $("#toggle-sidebar").click(function() {
      $('.page-wrapper').toggleClass('toggled');
    });

    $("#toggle-sidebar-right").click(function() {
      $('.page-wrapper').toggleClass('toggled');
    });

    $("#toggle-sidebar").click(function() {
      $('.page-wrapper').toggleClass('toggled-right');
      
    });


    
  }
}

function mobileAutoToggle(x) {
    if (x.matches) { // If media query matches
        $(".page-wrapper").removeClass("toggled");
        $(".page-wrapper").removeClass("toggled-right");
        
    } else {
        $(".page-wrapper").addClass("toggled");
        $(".page-wrapper").addClass("toggled-right");
    
    }
  }
  
  var x = window.matchMedia("(max-width: 575.98px)")
  mobileAutoToggle(x) // Call listener function at run time
  x.addListener(mobileAutoToggle) // Attach listener function on state changes

  var y = window.matchMedia("(max-width: 575.98px)")
  mobileToggleSolo(y) // Call listener function at run time
  y.addListener(mobileToggleSolo) // Attach listener function on state changes
   
});