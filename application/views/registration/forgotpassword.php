<?php 
$root = base_url();
?>
<section>
	<div class="container-fluid sing-in-form bg-background login-container">
		<div class="container">
			<div class="contact-form-1">
				<div class="col-md-12 col-sm-12 col-xs-12 asection5 sectionleft1 modalI">
					<div class="box-shadow col-md-5">
						<div class="section-head style-1">
							<h2 class="title">Reset Password</h2>
						</div>
						<form action="#" id="resetPassword" onsubmit="return showOtpBox()">
							<fieldset>
								<div class="col-md-12 col-sm-12 col-xs-12"
									style="display: flex; justify-content: center; flex-direction: column;">
									<div class="input-group">
										<div class="input-group-prepend" id="otpDiv"><span class="input-group-text">
												<i class="fa fa-unlock-alt" aria-hidden="true"></i>
											</span>
										</div>
										<input id="mobiles" name="otp" class="form-control" required
											placeholder="Enter Advisor Id" type="text">
									</div>
									<div class="form-group col-md-12 col-sm-12 col-xs-12 text-center">
										<div class="register">
											<a href="" type="submit" style="color: #fff;"
												class="btn-reply margin-zero btn-login col-md-6 col-sm-6 col-xs-12">Submit</a>
										</div>
									</div>

								</div>

							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	function showOtpBox() {
		var a = $('#mobiles').val();

		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>Registration/genrateOTP",
			data: {
				otp: a
			},
			success: function (data) {

				if (data == '1') {
					$('#resetPassword')[0].reset();
					location.reload();
				} else {
					alert("Please Enter correct Email Id.");
				}
			},
		});

		return false;
	}
</script>
<script>
	function resendOtp() {
		var a = document.getElementById('mobiles').value;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>Registration/genrateOTP",
			data: {
				otp: a
			},
			success: function (data) {
				document.getElementById('mobilesa').value = '';
				alert("Password resend sucessfully");
			},
		});
	}
</script>