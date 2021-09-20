
<div class="container-fluid margin_top_14 bg-background">
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
			<h2 class="sign-in text-center" style="color:#459c09;margin-bottom:40px">Login Now</h2>
				<div class="form-group">
					<input id="mobiles" name="unique_id" class="form-control" placeholder="Advisor ID" required  type="text">
					
					
					</div>
				<div class="form-group">
					<input id="mobiles" name="password" class="form-control" placeholder="Password" required  type="password">
					
					</div> 			
				<div class="col-sm-12 col-sm-12 col-xs-12 text-right paddingZ">
				  <div class="forgot-password"><a href="<?php echo base_url('forgot-password') ?>">Forgot Your Password ?</a></div>
				</div> 
				<div class="form-group col-sm-12 col-sm-12 col-xs-12 ">
				  <div class="register">
					<button type="submit" class="btn-reply margin-zero btn-login" name="login" value="login" >login</button>
				  </div>
				</div>
			
            </div>

				<div class="form-group col-sm-12 col-sm-12 col-xs-12 ">
					<p class="read-more-btn" style="text-align:center">
					<strong>Not An Account? <a href="<?php echo base_url(); ?>registration">Sign up Now</a></strong> <br>
					<br>
		  </div>
          </fieldset>
        <?php echo form_close(); ?>
     </div>
      </div>
    </section>
  </div>
</div>
</div>
