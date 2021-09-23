<?php 
	$root = base_url();
?>
<style>
.register-form{
    display: unset !important;
    justify-content: !important;
}
.register-btns{
	margin-bottom: 20px !important;
    margin: auto;
    text-align: center;
    display: flex;
    background-color: #f55f8d;
    color: #fff;
    padding: 8px 16px;
    border-radius: 28px;
}

</style>
<section>
	<div class="container-fluid sing-in-form bg-background login-container">
		<div class="container">
			<div class="contact-form-1">
				<div class="col-md-12 col-sm-12 col-xs-12 asection5 sectionleft1 modalI">
					<div class="box-shadow col-md-5">
						<div class="section-head style-1">
						<h2 class="title">Registration</h2>
						</div>
					<div class="col-md-12 col-sm-12 col-xs-12 register-form" style="display: flex; justify-content: center;">
						<?php echo validation_errors(); ?>
						<?php  echo form_open_multipart(base_url('registration')); ?>
						<?php 
										$pinValue='';$uniqueid='';
										if(isset($_GET['pin']))
										{
											$pinValue=$_GET['pin'];
										}
										
										if(isset($_GET['uniqueid']))
										{
											$uniqueid=$_GET['uniqueid'];
										}
										$side='';
										if(isset($_GET['uniqueid']))
										{
											$side=$_GET['side'];
										}
										/*1st PART OF REGISTRATION*/
										if($active==1)
										{
									  ?>
						<!--
									  <div class="form-group"  >
											<!--<label for="unique_id">Enter PIN  <span class="required"> * </span></label>-->
						<!--<input type="text" placeholder="Enter PIN"  required name="pin" value="<?php if($pinValue!='') { echo $pinValue; }else{ echo set_value('pin'); } ?>" class="form-control"   >
										 </div>  -->
										 <div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text">
										<i class="fa fa-user"></i>
										</span>
									</div>
									<input type="text" placeholder="Sponsor ID" required name="unique_id"
								value="<?php if($uniqueid!=''){ echo $uniqueid; }else{ echo set_value('unique_id'); } ?>"
								class="form-control" id="unique_id">
								</div>
						
								<div class="input-group" style="width: 100%;">
										<div class="input-group-prepend"><span class="input-group-text">
										<i class="fa fa-arrows-alt" aria-hidden="true"></i>
										</span>
									</div>
									<select class="form-control" name="tree_side">
								<option <?php if($side=='left'){ echo 'selected'; } ?> value="left">Left Side</option>
								<option <?php if($side=='right'){ echo 'selected'; } ?> value="right">Right Side
								</option>
							</select>
								</div>
				
						<div class="form-group  text-center col-sm-12 col-sm-12 col-xs-12 " style="margin-bottom: 0;">
							<div class="register">
								<button type="submit" class="btn-reply margin-zero btn-login text-white" id="submit_reg_bt"
									name="register" value="register"
									 	style="background: transparent;border:none;color:#fff">Register</button>
							</div>
						</div>

						<?php }else { ?>
						<div class="form-group" id="sponser_id_div">
							<input type="text" required placeholder="Desired Member ID" name="unique_id" value=""
								class="form-control" id="unique_id">
						</div>

						<div class="form-group" style="padding:0px">
							<select class="form-control" name="name_type" id="name_type" required>
								<option <?php if(set_value('name_type')=='Mr'){ echo "selected"; } ?> value="Mr">Mr
								</option>
								<option <?php if(set_value('name_type')=='Mrs'){ echo "selected"; } ?> value="Mrs">Mrs
								</option>
								<option <?php if(set_value('name_type')=='Miss'){ echo "selected"; } ?> value="Miss">
									Miss</option>
								<option <?php if(set_value('name_type')=='Dr'){ echo "selected"; } ?> value="Dr">Dr.
								</option>
								<option <?php if(set_value('name_type')=='M/S'){ echo "selected"; } ?> value="M/S">M/S
								</option>
							</select>
						</div>

						<div class="form-group" style="padding:0px">
							<input type="text" required class="form-control" placeholder="Your Full Name" name="name"
								value="<?php echo set_value('name'); ?>" class="form-control">
						</div>

						<div class="form-group">
							<select required class="form-control" name="gender" id="gender">
								<option <?php if(set_value('gender')=='Male'){ echo "selected"; } ?> value="Male">Male
								</option>
								<option <?php if(set_value('gender')=='Female'){ echo "selected"; } ?> value="Female">
									Female</option>
								<option <?php if(set_value('gender')=='Other'){ echo "selected"; } ?> value="Other">
									Other</option>
							</select>
						</div>
						<div class="form-group" id="sponser_id_div">
							<input type="email" placeholder="Your Email ID" name="email"
								value="<?php echo set_value('email'); ?>" class="form-control" id="email">
						</div>
						<div class="form-group">
							<input type="text" required placeholder="Your Mobile No" name="mobile"
								value="<?php echo set_value('mobile'); ?>" class="form-control" id="mobile">
						</div>
						<div class="form-group">
							<input type="password" required placeholder="Password" name="password"
								value="<?php echo set_value('password'); ?>" class="form-control" id="password">
						</div>
						<div class="form-group">
							<input type="password" required placeholder="Confirm Password" name="password1"
								value="<?php echo set_value('password1'); ?>" class="form-control" id="password1">
						</div>
						<!--<input type="hidden" name="pin"  required value="<?php echo $pin; ?>" />-->
						<input type="hidden" name="referrer_id" required value="<?php echo $unique_id; ?>" />
						<input type="hidden" name="tree_side" required value="<?php echo $tree_side; ?>" />
						<button type="submit" class="btn btn-default register-btns" id="submit_reg_bt" name="register"
							value="register1" style="margin-bottom:20px;">Register</button>
						<?php } ?>
						<?php echo form_close(); ?>
					</div>
						</div>
			</div>
		</div>
	</div>
</section>
<script>
	Sponser_id_fun('no');

	function Sponser_id_fun(value_id) {
		document.getElementById('feature_loader').style.display = "block";
		if (value_id == "yes") {
			document.getElementById('sponser_id_div').style.display = "block";
			$('#sponsor_id_input').attr('required', true);
		} else {
			document.getElementById("sponsor_id_input").required = false;
			document.getElementById('sponser_id_div').style.display = "none";
		}
		document.getElementById('feature_loader').style.display = "none";
	}
</script>
<script>
	$(function () {
		$("#datepicker").datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
</script>
<script>
	var root5 = '<?php echo $root; ?>';

	function checkUniqueIdFun() {
		document.getElementById('feature_loader').style.display = "block";
		var Unique_id = $('#sponsor_id_input').val();
		if (Unique_id != '') {
			$.ajax({
				type: "POST",
				url: root5 + '/Registration/CheckUserIdAjax',
				data: {
					Unique_id1: Unique_id
				},
				success: function (data) {
					if (data != '') {
						$('#details_parent').html(data);
						document.getElementById('valid_id').style.display = "block";
						document.getElementById('invalid_id').style.display = "none";
						$('#submit_reg_bt').attr('disabled', false);
					} else {
						$('#details_parent').html('');
						document.getElementById('valid_id').style.display = "none";
						document.getElementById('invalid_id').style.display = "block";
						$('#submit_reg_bt').attr('disabled', 'disabled');
					}
					document.getElementById('feature_loader').style.display = "none";
				},
			});
		} else {
			document.getElementById('feature_loader').style.display = "none";
			alert("Unique Id must be filled out");
		}
	}
</script>