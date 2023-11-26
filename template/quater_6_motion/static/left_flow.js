jQuery(function() {
    var elm = jQuery('#left_flow');
    var startPos = jQuery(elm).offset().top;//115
    jQuery.event.add(window, "scroll",
    function() {
        var p = jQuery(window).scrollTop() + 115;
        jQuery(elm).css('position', ((p) > startPos) ? 'fixed': 'static');
        jQuery(elm).css('top', ((p) > startPos) ? '0': '');
        jQuery(elm).css('padding-top', ((p) > startPos) ? '115px': '');
    });
    jQuery("#left_flow li").click(function() {
        jQuery('body,html').animate({
            scrollTop: 345
        },
        500);
        return false;
    });
});