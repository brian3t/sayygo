//    sidebar dropdown menu
$('').hover(function(){    var sub = jQuery(this).next();

        jQuery('.arrow', jQuery(this)).addClass("open");
        jQuery(this).parent().addClass("open");
        sub.slideDown(200);
});
$('.nav.navbar-top-links a.dropdown-toggle, .nav.navbar-top-links ul.dropdown-menu').hover(function () {
    var last = jQuery('.sub-menu.open', $('#sidebar'));
    last.removeClass("open");
    jQuery('.arrow', last).removeClass("open");
    jQuery('.sub', last).slideUp(200);
    var sub = jQuery(this).next();

        jQuery('.arrow', jQuery(this)).addClass("open");
        jQuery(this).parent().addClass("open");
        sub.slideDown(200);

}, function(){    
        var sub = jQuery(this).next();
        jQuery('.arrow', jQuery(this)).removeClass("open");
        jQuery(this).parent().removeClass("open");
        sub.slideUp(200);
    });

//if width>979px show sidebar
if ($(window).width() > 979) {
    $('#sidebar').addClass('in');
}

//mobile or tablet
if ($(window).width() <= 768) {
    $('a.navbar-brand').removeAttr('href');
    $('#navbar-collapse-1 a.dropdown-toggle').removeAttr('href');
    $('div.navbar-collapse ul.dropdown-menu > li > a').on('touchend', function(e){window.location.href = $(this).attr("href");});
}

$('#toggle_browse').on('click touchend', function(event){
    $('#browse-input').slideToggle();
});