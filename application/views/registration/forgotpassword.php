
<?php 
$root = base_url();
?>
<section >
	<div class="container-fluid sing-in-form bg-background" >
					<div class="container" >
					<div class="contact-form-1">
					<div class="col-md-12 col-sm-12 col-xs-12 asection5 sectionleft1 modalI" 
					style="background:#fff;margin-top:50px;margin-bottom:50px;border-radius:4px;boder:0;box-shadow: 0 0 7px rgba(0,0,0,.1) !important;padding-bottom:50px !important">     
					<h2 class="sign-in text-center" style="color:#459c09;margin-bottom: 40px;">Reset Password</h2>
	 <form action="#" id="resetPassword" onsubmit="return showOtpBox()" >
		<fieldset>
			<div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
				<div class="form-group" id="otpDiv"  >
					<input id="mobiles" name="otp" class="form-control" required placeholder="Enter Advisor Id"  type="text">
				</div>
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
				  <div class="register">
						<button type="submit"   class="btn-reply margin-zero btn-login col-md-6 col-sm-6 col-xs-12">Submit</button>
				  </div>
				</div>
			
            </div>

          </fieldset>
      </form>
     </div>
      </div>
  </div>
</div>
</section>
<script> 
function showOtpBox(){
	var a=$('#mobiles').val(); 
 
	$.ajax({
	type: "POST",
	url: "<?php echo base_url(); ?>Registration/genrateOTP",   
	data:{ otp: a}, 
	success: function(data){
		 
		if(data=='1')
		{
			$('#resetPassword')[0].reset();
			location.reload();
		}
		else
		{
			alert("Please Enter correct Email Id.");
		}
	}, 
	});	
	
	return false;
}
</script>
<script>
function resendOtp(){
	var a=document.getElementById('mobiles').value;
	$.ajax({
	type: "POST",
	url: "<?php echo base_url(); ?>Registration/genrateOTP",   
	data:{otp: a}, 
	success: function(data){
		document.getElementById('mobilesa').value='';
		alert("Password resend sucessfully");
	}, 
	});	
}
</script>