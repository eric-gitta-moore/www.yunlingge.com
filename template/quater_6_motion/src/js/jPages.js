jQuery(document).ready(function() {
    var newslist = function(jQuerychildren, n) {
        var jQueryhiddenChildren = jQuerychildren.filter(":hidden");
        var cnt = jQueryhiddenChildren.length;
        for (var i = 0; i < n && i < cnt; i++) {
            jQueryhiddenChildren.eq(i).fadeIn();

        }
        return cnt - n; 
    }

    jQuery(".newslist").each(function() {
        var pagenum = jQuery(this).attr("pagenum") || 15;
        var jQuerychildren = jQuery(this).children();
        if (jQuerychildren.length > pagenum) {
            for (var i = pagenum; i < jQuerychildren.length; i++) {
                 jQuerychildren.eq(i).hide();
            }
            jQuery("<div class=\"news-more\"><a id=\"more\" class=\"addmore\">加载更多</a></div><style>.newslist{ width: 100%; max-height: 100%; overflow: visible}</style>").insertAfter(jQuery(this)).click(function() {
                if (newslist(jQuerychildren, pagenum) <= 0) {
				    jQuery(this).html("<div class=\"news-more\"><a href=\"#\" id=\"more\" class=\"addmore\">前往频道</a></div>");
                };
            });
        }
    });

});