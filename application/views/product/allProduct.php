<?php 
$root = root();

$cond="status='1'";
$result=SelectQuery_th('*','products',$cond);
?>
<div class="container-fluid" style="padding:0">
<img src="<?php echo $root; ?>web_root/images/banner.png" class="img-responsive">
</div>
<div class="container-fluid bg-white12">
  <div class="row">
    <!-- ABOUT -->
	
			<div class="about-titel"> 
				<h3 class="about-company">Our Products</h3> 
				<div class="aboutcompanyafter"></div> 
			</div>
    <!-- OUR PRODUCTS -->
	
	<div class="container">
        <div class="row">
        <?php if(!empty($result)) {?>
		<?php foreach($result as $key=>$value) {
			$price=$value->price;
			$service_tax=$value->service_tax;
			$totalAmount=($price*$service_tax)/100;
			$totalAmount11=$price+$totalAmount;
			?> 
		
		  <div class="col-md-3 col-sm-6 col-xs-12 prodbox paddingZ" style="">
		  <div class="col-sm-12 col-md-12 col-xs-12   blognews" >							        
							<div class="col-sm-12 col-md-12 col-xs-12 prod-box1" style="padding:0px 0px;float:left;"> 
								<a href="#">	
									</a>
									<div class="grid">
										<figure class="col-md-6 col-sm-6 col-xs-12 tag-list-img padd0 fgr11">
									<a class="example-image-link" href="<?php echo $root; ?>web_root/images/product_image/<?php echo $value->image_name; ?>" data-lightbox="example-set" 
									data-title="Click the right half of the image to move forward."  style="overflow:hidden;">
									    <img class="example-image img-responsive" src="<?php echo $root; ?>web_root/images/product_image/<?php echo $value->image_name; ?>" alt=""></a>
								
										</figure>
									</div>
								<!--
								<div class="thumbnail11">
									<h4 class="" style="margin-bottom:0px">
										<a href="#">	
										<?php echo $value->name; ?> &nbsp(rs <?php echo $totalAmount11; ?>)</a>
									</h4>
									<h5 style="margin-top:-12px">Business Volume :-rs (<?php echo $value->business_volume; ?>)</h5>
									 <ul class="prime-features"><li><?php echo $value->service_tax; ?> rs</li>
									</ul>										
									<div class="col-xs-12 price-txt111 paddingZ">
										 <i class="fa fa-inr "></i> <?php echo $value->price; ?>*						</div>									
								</div>	
								-->
							</div>
							
						</div>
						</div>
						
						
						
						<?php } ?>
          
        </div>
      </div>
	<?php } else {?>
	<h3 style="text-align: center;">No Product Found</h3><?php } ?>
  </div>
</div>
<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/lightbox-plus-jquery.min.js"></script>