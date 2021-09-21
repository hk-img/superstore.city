<?php 
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

?>




<div class="container-fluid bg-white12 contact-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="about-titel " style="width:100%;">
					<div class="section-head style-1">
						<h2 class="title">Find Us On Map</h2>
					</div>
					<div class="aboutcompanyafter" style="margin: 0px auto 25px;"></div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 map1">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113191.97347580465!2d76.5763346241045!3d27.554776389100606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3972998fa7e65df3%3A0x38cebba39ee426f2!2sAlwar%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1481199644705"
					style="border:0;" allowfullscreen="" width="100%" height="350" frameborder="0"></iframe></div>

		</div>
	</div>

</div>

<div class="container-fluid" style="padding: 25px 15px 50px;">
	<div class="container" style="padding:0px;">
		<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;  display: flex; align-items: center;">
			<div class="col-md-6 col-sm-6 col-xs-12 borderRight">
				<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0px;">
					<div class="about-titel " style="width:100%;">
						<div class="section-head style-1">
							<h2 class="title">Send Us Mail</h2>
						</div>
						<div class="aboutcompanyafter" style="margin: 0px auto 25px;"></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="input-group" style="width: 100%;">
						<div class="input-group-prepend"><span class="input-group-text">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</span>
						</div>
						<input class="inputtext form-control" id="name" name="name" required="" type="text"
							placeholder="Your Name">
					</div>
					<div class="input-group" style="width: 100%;">
						<div class="input-group-prepend"><span class="input-group-text">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>
						<input class="inputtext form-control" id="email" name="email" required="" type="email"
							placeholder="Your Email">
					</div>
					<div class="input-group" style="width: 100%;">
						<div class="input-group-prepend"><span class="input-group-text">
								<i class="fa fa-mobile" aria-hidden="true"></i>
							</span>
						</div>
						<input class="inputtext form-control" id="phone" name="phone" style="width:100%;" required=""
							type="number" placeholder="Phone Number">
					</div>
					<div class="input-group" style="width: 100%;">
						<div class="input-group-prepend"><span class="input-group-text">
						<i class="fa fa-book" aria-hidden="true"></i>
							</span>
						</div>
						<textarea class="inputtext form-control" id="massege" name="massage"
							style="height:100px;width:75%;" required=""></textarea>
					</div>
					<div class="form-group">
						<div class="register">
							<a href="" type="submit" style="color: #fff;"
								class="btn-reply margin-zero btn-login col-md-6 col-sm-6 col-xs-12">Submit</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-5 wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.4s">
         <div class="dlab-media"><img src="web_root/images/img2.png" class="move-2" alt=""></div>
       </div>
		</div>
	</div>
</div>