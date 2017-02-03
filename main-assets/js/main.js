jQuery(document).scroll(function(event){

  
  var y = $(this).scrollTop();
  if (y > 100) {
    $('#mobile-menu').fadeIn();
  } else {
    $('#mobile-menu').fadeOut();
  }

});

jQuery(document).ready(function(event){
  var newloc;

  $('html').on('click', 'a[data-target]', function(event){
    var data_id = $(this).attr('data-target');
    $( "#" + data_id).toggle("slow");
  });

  $('html').on('click', 'a[href!="#"]', function(event){
    event.preventDefault();
    newloc = $(this).attr('href');
    $('body').fadeOut(1000, newpage);
  });



  $('html').on('click', '[menu]', function(event){
    $( "#bigmenu" ).css("display", "block");
    $( "#bigmenu" ).animate({opacity: 1}, 1000 );
  });


  $('#bigmenu').on('click', '.close', function(event){
    $( "#bigmenu" ).css("display", "none");
    $( "#bigmenu" ).css("opacity", "0");
  });

  function newpage() {

    window.location = newloc;

    }

  $("body").niceScroll({
    cursorcolor:"#df9c8f",
    cursorborderradius: "0px",
    zindex: "9999999999999999999999",
    autohidemode: false
  });

  $(".inside-project").niceScroll({
    cursorcolor:"#df9c8f",
    cursorborderradius: "0px",
    zindex: "9999999999999999999999",
    autohidemode: false
  });

});