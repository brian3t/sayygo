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
$(document).ready(function(){
    $('.editable').each(function(){
        this.contentEditable = true;
    });
});