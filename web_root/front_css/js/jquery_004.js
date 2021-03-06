/*
 *
 * Copyright (c) 2014 Daniele Lenares (https://github.com/Ryuk87)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * 
 * Version 1.0.0
 *
 */
(function(e) {
    function t(e, t, n) {
        if (t == "show") {
            switch (n) {
                case "fade":
                    e.fadeIn();
                    break;
                case "slide":
                    e.slideDown();
                    break;
                default:
                    e.fadeIn()
            }
        } else {
            switch (n) {
                case "fade":
                    e.fadeOut();
                    break;
                case "slide":
                    e.slideUp();
                    break;
                default:
                    e.fadeOut()
            }
        }
    }
    e.goup = function(n) {
        var r = e.extend({
            location: "right",
            locationOffset: 20,
            bottomOffset: 10,
            containerSize: 40,
            containerRadius: 5,
            containerClass: "goup-container",
            arrowClass: "goup-arrow",
            alwaysVisible: false,
            trigger: 500,
            entryAnimation: "fade",
            goupSpeed: "slow",
            hideUnderWidth: 500,
            title: "",
            titleAsText: false,
            titleAsTextClass: "goup-text"
        }, n);
        e("body").append('<div style="display:none" class="' + r.containerClass + '"></div>');
        var i = e("." + r.containerClass);
        e(i).html('<div class="' + r.arrowClass + '"></div>');
        var s = e("." + r.arrowClass);
        if (r.location != "right" && r.location != "left") {
            r.location = "right.html"
        }
        if (r.locationOffset < 0) {
            r.locationOffset = 0
        }
        if (r.bottomOffset < 0) {
            r.bottomOffset = 0
        }
        if (r.containerSize < 20) {
            r.containerSize = 20
        }
        if (r.containerRadius < 0) {
            r.containerRadius = 0
        }
        if (r.trigger < 0) {
            r.trigger = 0
        }
        if (r.hideUnderWidth < 0) {
            r.hideUnderWidth = 0
        }
        var o = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i;
        if (r.title === "") {
            r.titleAsText = false
        }
        var u = {};
        u = {
            position: "fixed",
            width: r.containerSize,
            height: r.containerSize,
            background: r.containerColor,
            cursor: "pointer"
        };
        u["bottom"] = r.bottomOffset;
        u[r.location] = r.locationOffset;
        u["border-radius"] = r.containerRadius;
        e(i).css(u);
        if (!r.titleAsText) {
            e(i).attr("title", r.title)
        } else {
            e("body").append('<div class="' + r.titleAsTextClass + '">' + r.title + "</div>");
            var a = e("." + r.titleAsTextClass);
            e(a).attr("style", e(i).attr("style"));
            e(a).css("background", "transparent").css("width", r.containerSize + 40).css("height", "auto").css("text-align", "center").css(r.location, r.locationOffset - 20);
            var f = e(a).height() + 10;
            e(i).css("bottom", "+=" + f + "px")
        }
        var l = {};
        var c = .25 * r.containerSize;
        l = {
            width: 0,
            height: 0,
            margin: "0 auto",
            "padding-top": Math.ceil(.325 * r.containerSize),
            "border-style": "solid",
            "border-width": "0 " + c + "px " + c + "px " + c + "px",
            "border-color": "transparent transparent " + r.arrowColor + " transparent"
        };
        e(s).css(l);
        var h = false;
        e(window).resize(function() {
            if (e(window).outerWidth() <= r.hideUnderWidth) {
                h = true;
                t(e(i), "hide", r.entryAnimation);
                if (a) t(e(a), "hide", r.entryAnimation)
            } else {
                h = false;
                e(window).trigger("scroll")
            }
        });
        if (e(window).outerWidth() <= r.hideUnderWidth) {
            h = true;
            e(i).hide();
            if (a) e(a).hide()
        }
        if (!r.alwaysVisible) {
            e(window).scroll(function() {
                if (e(window).scrollTop() >= r.trigger && !h) {
                    t(e(i), "show", r.entryAnimation);
                    if (a) t(e(a), "show", r.entryAnimation)
                }
                if (e(window).scrollTop() < r.trigger && !h) {
                    t(e(i), "hide", r.entryAnimation);
                    if (a) t(e(a), "hide", r.entryAnimation)
                }
            })
        } else {
            t(e(i), "show", r.entryAnimation);
            if (a) t(e(a), "show", r.entryAnimation)
        }
        if (e(window).scrollTop() >= r.trigger && !h) {
            t(e(i), "show", r.entryAnimation);
            if (a) t(e(a), "show", r.entryAnimation)
        }
        var p = true;
        e(i).add(a).on("click", function() {
            if (p) {
                p = false;
                e("html,body").animate({
                    scrollTop: 0
                }, r.goupSpeed, function() {
                    p = true
                })
            }
            return false
        });
    }
})(jQuery);
