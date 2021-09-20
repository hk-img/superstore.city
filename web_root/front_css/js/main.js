var $ = jQuery.noConflict();
$(document).ready(function() {
    //---------------------------------------------------------------------------------------
    //Enable Hover for Bootstrap Nav Dropdowns
    //---------------------------------------------------------------------------------------
    var status = 'closed';
    if ($(window).width() > 768) {
        $('.navbar .dropdown').hover(function() {
            $(this).addClass('open');
            status = 'open';
        }, function() {
            $(this).removeClass('open');
            status = 'closed';
        });
        //Compatibility with desktop monitors that support touchscreen
        $('.dropdown').on('touchstart', function(){
            if (status == 'closed'){
                $('.navbar .dropdown').addClass('open');
                status = 'open';
            } else {
                $('.navbar .dropdown').removeClass('open');
                status = 'closed';
            }
        });
    }
    //---------------------------------------------------------------------------------------
    //Header Background Slideshow - Flexslider
    //---------------------------------------------------------------------------------------
    if ($('#bg-slider').length) {
        /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
        $('#bg-slider').flexslider({
            animation: "fade",
            slideshow: true,
            animationLoop: true,
            directionNav: false, //remove the default direction-nav
            controlNav: false, //remove the default control-nav
            slideshowSpeed: 6000,
        });
    };
    //---------------------------------------------------------------------------------------
    //OWL Carousel
    //---------------------------------------------------------------------------------------
    if ($('.owlcarousel').length) {
        $('.owlcarousel').owlCarousel({
            loop: true,
            margin: 5,
            autoplay: true,
            autoplayHoverPause: true,
            nav: true,
            dots: false,
            navText: ['&#8249;', '&#8250;'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                800: {
                    items: 4,
                },
                1000: {
                    items: 6,
                }
            }
        })
    };
    //---------------------------------------------------------------------------------------
    //Header Shrink
    //---------------------------------------------------------------------------------------
    ////if ($(window).width() > 767) {
     //   $(window).scroll(function() {
     //       if ($(document).scrollTop() < 40) {
    //            $('.navbar').removeClass('tiny');
    //        } else {
    //           $('.navbar').addClass('tiny');
     //       }
    //    });
 //   }
    //---------------------------------------------------------------------------------------
    //Scroll to Top
    //---------------------------------------------------------------------------------------
    jQuery.goup({
        trigger: 600,
        bottomOffset: 25,
        locationOffset: 25
    });
    //---------------------------------------------------------------------------------------
    //Vanillabox
    //---------------------------------------------------------------------------------------
    if ((jQuery('.lightbox').length)) {
        jQuery('.lightbox').vanillabox({
            closeButton: true,
            keyboard: true
        });
    };
    if ((jQuery('.webpage').length)) {
        jQuery('.webpage').vanillabox({
            type: 'iframe',
            closeButton: true,
            keyboard: true
        });
    };
    //---------------------------------------------------------------------------------------
    //Video
    //---------------------------------------------------------------------------------------
    if ($('iframe').length) {
	    $('iframe').each(function(){
            var ifr_source = $(this).attr('src');
            var wmode = '?wmode=transparent';
            $(this).attr('src',ifr_source+wmode);
        });
	};
    //---------------------------------------------------------------------------------------
    //Counter Up
    //---------------------------------------------------------------------------------------
    if ($('.counter').length) {
        $('.counter').counterUp({
            delay: 100,
            time: 800
        });
    };
    //---------------------------------------------------------------------------------------
    //Portfolio
    //---------------------------------------------------------------------------------------
    if ($('#grid').length) {
        $('#grid').mixitup();
    };
    //---------------------------------------------------------------------------------------
    //Select
    //---------------------------------------------------------------------------------------
    if ($('.selectpicker').length) {
        $('.selectpicker').selectpicker({
            style: 'selectcorp'
        });
    };
    //---------------------------------------------------------------------------------------
    //Contact Form
    //---------------------------------------------------------------------------------------
    if ($('#contactform').length) {
        $('#contactform').on('submit', function() {
            if (!$(this).validate($('#alertform'))) {
                return false;
            }
        });
    };
    //---------------------------------------------------------------------------------------
    //Google Maps
    //---------------------------------------------------------------------------------------
    if ($('#map-canvas').length) {
        var myLatlng;
        var map;
        var marker;
        function initialize() {
            myLatlng = new google.maps.LatLng(25.8370791, -80.3364766);
            var mapOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                draggable: false,
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var contentString = '<p style="line-height: 20px;"><strong>Corpboot</strong></p><p>8578 NW 70th Street, 33166, Miami - Florida, USA</p>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Marker'
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    };
});
