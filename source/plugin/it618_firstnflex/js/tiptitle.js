jQuery(document).ready(function(){

jQuery('.quicktip').quberTip({

  speed:200

});

});

jQuery.fn.quberTip = function (options) {


    var defaults = {

        speed: 500,

        xOffset: 10,

        yOffset: 10

    };


    var options = jQuery.extend(defaults, options);


    return this.each(function () {


        var jQuerythis = jQuery(this);


        if (jQuerythis.attr('title') != undefined) {

            //Pass the title to a variable and then remove it from DOM

            if (jQuerythis.attr('title') != '') {

                var tipTitle = jQuerythis.attr('title')+jQuerythis.parent().children("div:first").html();

            } else {

                var tipTitle = 'QuberTip';

            }

            //Remove title attribute

            jQuerythis.removeAttr('title');


            jQuery(this).hover(function (e) {

                //jQuery(this).css('cursor', 'pointer');

                jQuery("body").append("<div id='tooltip'>" + tipTitle + "</div>");

				jQuery("#tooltip").addClass("it618_floatdiv");

                jQuery("#tooltip")

.css("top", (e.pageY + defaults.xOffset) + "px")

            .css("left", (e.pageX + defaults.yOffset) + "px")

            .fadeIn(options.speed);


            }, function () {

                //Remove the tooltip from the DOM

                jQuery("#tooltip").remove();

            });


            jQuery(this).mousemove(function (e) {

                jQuery("#tooltip")

    .css("top", (e.pageY + defaults.xOffset) + "px")

    .css("left", (e.pageX + defaults.yOffset) + "px");

            });

        }

    });

};

