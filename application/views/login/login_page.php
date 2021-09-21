<div class="container-fluid login-container">
	<div class="container">
		<div class="row">
			<section class="contact-block">
				<div class="contact-form">
					<div class="col-sm-12 col-sm-12 col-xs-12">

						<?php 		  
				echo form_open_multipart('login');
			 ?>
						<fieldset>
							<?php echo validation_errors(); ?>
							<div class="col-sm-12 col-sm-12 col-xs-12 modalI">
								<div class="box-shadow col-md-5">
									
								<div class="section-head style-1">
									<h2 class="title">Login</h2>
								</div>

									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text">
											<i class="fa fa-user"></i>
										</span>
									</div>
									<input id="mobiles" name="unique_id" class="form-control" placeholder="Advisor ID"
										required type="text">
								</div>
								<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text">
										<i class="fa fa-unlock-alt" aria-hidden="true"></i>
										</span>
									</div>
									<input id="mobiles" name="password" class="form-control" placeholder="Password"
										required type="password">
								</div>

								<div class="col-sm-12 col-sm-12 col-xs-12 text-right paddingZ">
									<div class="forgot-password text-center"><a
											href="<?php echo base_url('forgot-password') ?>">Forgot Your Password ?</a>
									</div>
								</div>
								<div class="form-group text-center col-sm-12 col-sm-12 col-xs-12" style="margin-top: 15px; margin-bottom: 0;">
									<div class="register" style="margin-left: 0;">
										<a href="#" type="submit" class="btn-reply margin-zero btn-login" name="login"
											value="login" style="color: #fff; ">Login</a>
									</div>
								</div>

							</div>

							<div class="form-group col-sm-12 col-sm-12 col-xs-12 ">
								<p class="read-more-btn" style="text-align:center">
									<strong>Not An Account? <a href="<?php echo base_url(); ?>registration">Sign up
											Now</a></strong> <br>
									<br>
							</div>
							
							</div>
						</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>