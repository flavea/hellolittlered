

jQuery(document).scroll(function(event){

  
  var y = $(this).scrollTop();
  if (y > 100) {
    $('#mobile-menu').fadeIn();
  } else {
    $('#mobile-menu').fadeOut();
  }

});

jQuery(document).ready(function(event){
    
    if (typeof(Storage) !== "undefined") {
        var theme = localStorage.getItem("theme");
        if(theme === null) {
            localStorage.setItem("theme", "light");
        } else {
            if(theme == "light") {
                $('#fs').attr('checked', false);
                $('body').removeClass('dark');
            } else if(theme == "dark") {
                $('#fs').attr('checked', true);
                $('body').addClass('dark');
            }
            
        }
    } else {
        console.log("no local storage support.");
    }

  var newloc;

  $('pre').addClass('prettyprint');

  $('html').on('click', 'a[data-target]', function(event){
    var data_id = $(this).attr('data-target');
    $( "#" + data_id).toggle("slow");
  });

  $('html').on('click', 'a[href]:not(.close)', function(event){
    event.preventDefault();
    newloc = $(this).attr('href');
    $('body').fadeOut(1000, newpage);
  }); 

  $('html').on('click', 'a[href]:not([menu])', function(event){
    event.preventDefault();
    newloc = $(this).attr('href');
    $('body').fadeOut(1000, newpage);
  });

  $('html').on('click', 'a[href]:not([data-target])', function(event){
    event.preventDefault();
    newloc = $(this).attr('href');
    $('body').fadeOut(1000, newpage);
  });



  $('html').on('click', '[menu]', function(event){
    event.preventDefault();
    $( "#bigmenu" ).css("display", "block");
    $( "#bigmenu" ).animate({opacity: 1}, 1000 );
  });


  $('#bigmenu').on('click', '.close', function(event){
    event.preventDefault();
    $( "#bigmenu" ).css("display", "none");
    $( "#bigmenu" ).css("opacity", "0");
  });

  function newpage() {

    window.location = newloc;

    }

  $("body").niceScroll({
    cursorcolor:"#ffffff",
    cursorborderradius: "0px",
    zindex: "9999999999999999999999",
    autohidemode: false
  });

  $(".inside-project").niceScroll({
    cursorcolor:"#6d0000",
    cursorborderradius: "0px",
    zindex: "9999999999999999999999",
    autohidemode: false
  });
  
  $('#fs').change(function() { 
    if (this.checked) {
        localStorage.setItem("theme", "dark");
        $('body').addClass('dark');
    } else {
        localStorage.setItem("theme", "light");
        $('body').removeClass('dark');
    }
});


});