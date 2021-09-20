(function ($) {
 "use strict";

/*--------------------------------
 featured item
---------------------------------- */
     $(".featured-item").owlCarousel({
      navigation : true,
      pagination : false,
      autoPlay : 3000,
      slideSpeed : 600,
      paginationSpeed : 400,
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,3], 
      itemsTablet: [767,2], 
      itemsMobile : [480,1],
      navigationText : ['<i class="icon-left-open"><i class="fa fa-angle-left"></i></i>','<i class="icon-right-open"><i class="fa fa-angle-right"></i></i>'] 
  });    
})(jQuery);    