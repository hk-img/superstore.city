 
<?php 
$root = base_url();
?>

<style>
#popup button.close {
    position: absolute;
    right: -10px;
    background: #fff;
    opacity: 1;
    width: 30px;
    height: 30px;
    text-align: center;
    border-radius: 50%;
    top: -10px;
}
#popup .modal-dialog{margin-top: 50px;}
</style>
<style>
.darkheader {
    background: #fff;
    box-shadow: 0 0 7px rgba(0,0,0,.1) !important;
}
</style>

<section class="bg-white" id="about-us">
      <div class="container">
        <div class="row">
		
              <div class="logo-block col-sm-12 col-md-12 col-xs-12">
                <div class="about-titel"> 
				<h3 class="about-company">Welcome to AYR TRADEMART SOLUTION PVT. LTD.</h3> 
				<div class="aboutcompanyafter"></div> 
				</div>
              </div>
          <div style="visibility: visible; animation-delay: 60ms;" class="col-sm-7 col-md-7 col-xs-12 wow fadeInUp" data-wow-delay="60ms">
            <div class="home-about">
              <div class="clearfix"></div>
			   <p>Our team is focusing to develop a path of prosperity for past few year. Now, All people are invited to change their life and fulfill their dreams by imparting valuable education,prosperity and holistic development with our quality and trusted path.</p><p>
Life-vision is a dais provided to get achievement which is waiting for you.Our services will help people to achieve your goal. Our Team always ready to sort out all issue which will be hurdle in your journey. 
</p>
<p>
Company-name will ensure that every person will get fruit of his work with honesty.  Even though we have taken care to include all our products in this website we request you to kindly connected with the website for latest updates.
</p>
<p>
            </div>
          </div>
          <div style="visibility: visible; animation-delay: 120ms;" class="col-sm-5 col-md-5 col-xs-12 wow fadeInUp" data-wow-delay="120ms">
            <div class="home-about-img"><img src="<?php echo $root;?>web_root/images/about-img.png" class="img-responsive"></div>
          </div>
        </div>
      </div>
    </section>
<?php 
	if(!empty($all_product))
	{
?>
<div class="container-fluid bg-white12" style="background: #e7e7e7;">
	<div class="row">
		<div class="about-titel"> 
			<h3 class="about-company">Our Products</h3> 
			<div class="aboutcompanyafter"></div> 
		</div>
		<div class="container">
			<div class="row">
			    <div class="featured-item">
					<?php 
						foreach($all_product as $all_productValue)
						{
					?>
						<div class="col-md-12 col-sm-12 col-xs-12 prodbox paddingZ" style="">
							<div class="col-sm-12 col-md-12 col-xs-12   blognews">							        
								<div class="col-sm-12 col-md-12 col-xs-12 prod-box1" style="padding:0px 0px;float:left;"> 
									<div class="grid">
										<figure class="col-md-6 col-sm-6 col-xs-12 tag-list-img padd0 fgr11">
											<a class="example-image-link" href="<?php echo base_url(); ?>web_root/images/product_image/<?php echo $all_productValue['image_name']; ?>" data-lightbox="example-set" style="overflow:hidden;">
												<img class="example-image img-responsive" src="<?php echo base_url(); ?>web_root/images/product_image/<?php echo $all_productValue['image_name']; ?>" alt="product image">
											</a>
										</figure>
									</div>
								</div>
							</div>
						</div>   
					<?php } ?>
		    	</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<section id="features">
        <div class="container">
            <!-- Start Title -->
            <div class="row">
                 <div class="about-titel"> 
				<h3 class="about-company">Our Feature</h3> 
				<div class="aboutcompanyafter"></div> 
				</div>
            </div>
            <!-- End Title -->
            <!-- Start Features -->
            <div class="row wrap-feature-two">
                <div class="col-md-4">
                    <!-- Start Feature Two Left -->
                    <ul class="feature-two left">
                        <li>
                            <i class="icon icon-24 icon-tablet"></i>
                            <h5> Raw Garlic</h5>
                            <p>
                              
                            </p>
                        </li>
                        <li>
                            <i class="icon icon-24 icon-clipboard"></i>
                            <h5>Feverfew</h5>
                            <p>
                                 
                            </p>
                        </li>
                        <li style="margin-bottom: -19px;">
                            <i class="icon icon-24 icon-hourglass"></i>
                            <h5>Milk Thistle</h5>
                            <p>
                                
                            </p>
                        </li>
                    <span class="line"></span></ul>
                    <!-- End Feature Two Left -->
                </div>
                <div class="col-md-4">
                    <img src="<?php echo $root; ?>web_root/images/man.png" class="img-responsive img-feature-two" style="margin-left:50px" alt="">
                </div>
                <div class="col-md-4">
                    <!-- Start Feature Two Right -->
                    <ul class="feature-two right">
                        <li>
                            <i class="icon icon-24 icon-rocket"></i>
                            <h5>Ginseng</h5>
                            <p>
                                
                            </p>
                        </li>
                        <li>
                            <i class="icon icon-24 icon-gamecontroller"></i>
                            <h5>Turmeric</h5>
                            <p>
                                 
                            </p>
                        </li>
                        <li style="margin-bottom: -19px;">
                            <i class="icon icon-24 icon-interstate"></i>
                            <h5>Ginger</h5>
                            <p>
                                
                            </p>
                        </li>
                    <span class="line"></span></ul>
                    <!-- End Feature Two Right -->
                </div>
            </div>
            <!-- End Features -->
        </div>    
    </section>
	<style>
	</style>
	<!--	
	<div class="box betterway"><div class="box-wrap"><div class="content">
 <!--<h1>There has never been a better time to go fulfill their dreams. <br class="desktop"> And now, with the <span style="color:#FF7A00;">Life-Vision<sup></sup></span>, there has never been a better way.</h1>
--><!--<div class="cta">
</div>
</div></div></div>-->
<?php 
$messageResult=SelectQuery('*','message','id','1'); 
if(!empty($messageResult)){  
foreach($messageResult as $messageResultKey=>$messageResultValue){}
if($messageResultValue->message!=''){	
 ?>
<div id="popup" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<ul class="list-inline" style="margin: 0px;">
					<li>
					<?php echo $messageResultValue->message; ?>
					 </li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } } ?>
   
  </div>
</div>


	<?php 
		if(file_exists("./web_root/images/".$popup['image_name']) && $popup['image_name']!='')
		{
	?>
		<div class="modal fade" id="popupshow">
		  <div class="modal-content model-responsive" style="">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" style="background:#333; color:#fff; border-radius:50%; padding:4px 8px; position:absolute; right:-15px; top:-15px; opacity:1;">&times;</button>
			 <img src="<?php echo base_url();?>web_root/images/<?php echo $popup['image_name']; ?>" class="img-responsive">
			</div>
		  </div>
	   </div> 
	<?php } ?>
 
<script>
$(document).ready(function() { 
  var $scene = $(".scene"),
      $content = $(".content"),
      $back = $(".back"),
      $backBgs = $(".back__bg"),
      $front = $(".front"),
      $frontBgs = $(".front__bg"),
      $menuBlock = $(".menu__block"),
      $svgPath = $(".menu__block-svgPath"),
      animating = false,
      menuActive = false,
      menuAnimTime = 600,
      blockAnimTime = 1500,
      $sliderCont = $(".menu-slider__content"),
      curSlide = 1,
      sliderXDiff = 0,
      curPage = 1,
      nextPage = 0,
      numOfPages = $(".front__bg").length,
      scaleTime = 500,
      transTime = 500,
      totalTime = scaleTime + transTime,
      changeTimeout,
      timeoutTime = 8000,
      winW = $(window).width(),
      winH = $(window).height();
  
  // init nav element timeout animation
  $(".nav__el-1").addClass("active");
  
  //default debounce function from David Walsh blog
  function debounce(func, wait, immediate) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };
  
  function changePages() {
    $(".back__bg, .front__bg, .nav__el").removeClass("active");
    $(".nav__el-"+curPage).addClass("active");
    $back.css("transform", "translate3d(0,"+(curPage-1)*-100+"%,0)");
    $front.css("transform", "translate3d(0,"+(curPage-1)*100+"%,0)");
    createTimeout();

    setTimeout(function() {
      $(".back__bg-"+curPage+", .front__bg-"+curPage).addClass("active");
    }, totalTime);
  };
  
  $(document).on("click", ".nav__el:not(.active)", function() {
    curPage = $(this).attr("data-page");
    changePages();
  });
  
  // ugly hack for animation reset when you coming back from menu section
  function resetTimeoutAnimation() {
    var $activeNavEl = $(".nav__el.active"),
        $activeParts = $activeNavEl.find(".nav__el-clone, .nav__el")
    $activeParts.addClass("instant");
    $activeNavEl.removeClass("active");
    $activeParts.css("top");
    $activeParts.removeClass("instant");
    $activeParts.css("top");
    $activeNavEl.addClass("active");
  }
  
  /* creates timeOut for change of slides.
  Call's itself from inside of changePages() function
  */
  function createTimeout() {
    window.clearTimeout(changeTimeout);
    resetTimeoutAnimation();
    changeTimeout = setTimeout(function() {
      if (curPage >= numOfPages) {
        curPage = 1;
      } else {
        curPage++;
      }
      changePages();
    }, timeoutTime);
  };
  
  createTimeout();
  
  /* creates path D attribute strings for animation
  initial d = fullScreen
  mid d = Q curves with 5% padding
  final d = centered 90% width/height block
  */
  function createD(type) {
    var types = {"init": ["M0,0",
                          "Q"+winW/2+",0",
                          winW+",0",
                          "Q"+winW+","+winH/2,
                          winW+","+winH,
                          "Q"+winW/2+","+winH,
                          "0,"+winH,
                          "Q0,"+winH/2,
                          "0,0"],
                 "mid": ["M0,0",
                         "Q"+winW/2+","+winH*0.05,
                         winW+",0",
                         "Q"+winW*0.95+","+winH/2,
                         winW+","+winH,
                         "Q"+winW/2+","+winH*0.95,
                         "0,"+winH,
                         "Q"+winW*0.05+","+winH/2,
                         "0,0"],
                 "final": ["M"+winW*0.05+","+winH*0.05,
                           "Q"+winW/2+","+winH*0.05,
                           winW*0.95+","+winH*0.05,
                           "Q"+winW*0.95+","+winH/2,
                           winW*0.95+","+winH*0.95,
                           "Q"+winW/2+","+winH*0.95,
                           winW*0.05+","+winH*0.95,
                           "Q"+winW*0.05+","+winH/2,
                           winW*0.05+","+winH*0.05]};
    return types[type].join(" ");
  }
  
  // animates path d with SnapSVG
  function animateBlock(reverse) {
    winW = $(window).width();
    winH = $(window).height();
    var initD = createD("init"),
        midD = createD("mid"),
        finalD = createD("final");
    
    if (!reverse) {
      $svgPath.attr("d", initD);
      Snap($svgPath[0]).animate({"path": midD}, blockAnimTime/2, mina.elastic, function() {
        Snap($svgPath[0]).animate({"path": finalD}, blockAnimTime/2, mina.elastic);
      });
    } else {
      Snap($svgPath[0]).animate({"path": midD}, blockAnimTime/2, mina.elastic, function() {
        Snap($svgPath[0]).animate({"path": initD}, blockAnimTime/2, mina.elastic);
      });
    }
    
  };
  
  // resizes opened menu path d block, because i can't change viewBox with js
  var resizeSvg = debounce(function() {
    winW = $(window).width();
    winH = $(window).height();
    $svgPath.attr("d", createD("final"));
  }, 50);
  
  // default madness
  $(document).on("click", ".menu__btn", function() {
    if (animating) return;
    animating = true;
    setTimeout(function() {
      animating = false;
    }, blockAnimTime + menuAnimTime);
    
    if (!menuActive) {
      menuActive = true;
      window.clearTimeout(changeTimeout);
      $content.addClass("inactive");
      $scene.addClass("menu-visible");
      $(".back__bg:not(.active)").addClass("hidden");
      $(window).on("resize", resizeSvg);
      setTimeout(function() {
        $menuBlock.addClass("visible");
        animateBlock();
      }, menuAnimTime);
    } else {
      menuActive = false;
      animateBlock(true);
      setTimeout(function() {
        $menuBlock.removeClass("visible");
        createTimeout();
        $(".back__bg").removeClass("hidden");
        $content.removeClass("inactive");
        $scene.removeClass("menu-visible");
      }, blockAnimTime);
      $(window).off("resize");
    }
  });
  
});
</script>

<script type="text/javascript">
   $('#popupshow').modal('show');
</script>

<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/lightbox-plus-jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/slider-one.js"></script>