

	<?php 

		foreach($result as $key=>$value){}

	?>
	  <div class="content-wrapper">
		<div class="container-fluid">
		  <div class="row">
			<div class="col-lg-12">
		  <div class="card mb-3">
			<div class="card-header">
			        <i class="fa fa-pencil-square-o"></i> Edit Personal Details
	                <a href="<?php echo base_url('profile'); ?>"><span style="float:right;color:#fff"> <i class="fa fa-user"></i> Dashboard</span></a>
	        </div>
			<div class="card-body">                 
			<?php echo form_open_multipart('Profile/UpdateProfileEnd'); ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Name</div>
							<div class="col-lg-9 col-xs-12">
								<input <?php if($value->name!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->name; ?>" type="text" value="<?php echo $value->name; ?>"  class="form-control" name="name" autocomplete="off" required="required">
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Email-id </div>
							<div class="col-lg-9 col-xs-12">
								<input type="email" <?php if($value->email!='' && $value->package_amount>0){ echo "readonly"; } ?> value="<?php echo $value->email; ?>"  class="form-control" name="email" autocomplete="off">
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Father Name </div>
							<div class="col-lg-9 col-xs-12">
								<input  type="text" value="<?php echo $value->father_name; ?>"  class="form-control" name="father_name" autocomplete="off">
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Mobile No.</div>
							<div class="col-lg-9 col-xs-12">
								<input min="10" <?php if($value->mobile_no!='' && $value->package_amount>0 ){ echo "readonly"; } ?> type="number" value="<?php echo $value->mobile_no; ?>"  class="form-control" name="mobile_no" autocomplete="off"  >
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Occupation</div>
							<div class="col-lg-9 col-xs-12">
								<input type="text" value="<?php echo $value->occupation; ?>"  class="form-control" name="occupation" autocomplete="off">
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Image</div>
							<div class="col-lg-9 col-xs-12">
								<?php if($value->image!='' && file_exists('./web_root/images/userimage/'.$value->image)){ ?> 
									<img src="<?php echo base_url('web_root/images/userimage/').$value->image; ?>" style="height:100px;width:100px" /> 
									<?php }else{ ?>
									<input  type="file" value=""  class="form-control" name="model_image" >
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Address</div>
							<div class="col-lg-9 col-xs-12">
							   <textarea  name="address" rows="2" cols="20" id="txtAddress" class="form-control"> <?php echo $value->address; ?></textarea>
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> State</div>
							<div class="col-lg-9 col-xs-12">
								<select class="form-control selectpicker" name="state" <?php if($value->state!='' && $value->state!='0'){ echo "disabled"; } ?>  onchange="getCity(this.value)">
									<option <?php if($str_statesValue->id==$value->state){ echo "selected"; } ?> value="">Please select state</option>
									<?php 
										$stateResult=$this->db->where('country_id','101')->get('str_states')->result();
										foreach($stateResult as $str_statesKey=>$str_statesValue)
										{
									?>
										<option <?php if($str_statesValue->id==$value->state){ echo "selected"; } ?> value="<?php echo $str_statesValue->id; ?>"><?php echo $str_statesValue->name; ?></option>
									<?php } ?>
								</select> 
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> City</div>
							<div class="col-lg-9 col-xs-12">
								<select class="form-control" name="city" id="city_id" <?php if($value->city!='' && $value->city!='0' ){ echo "disabled"; } ?> >
									  <option value="">No City found.</option> 
									  <?php 
										if($value->city!='')
										{
										$cityResult=$this->db->where('id',$value->city)->get('str_cities')->result();
										foreach($cityResult as $cityResultKey=>$cityResultValue)
										{
									?>
										<option <?php if($cityResultValue->id==$value->city){ echo "selected"; } ?> value="<?php echo $cityResultValue->id; ?>"><?php echo $cityResultValue->name; ?></option>
									<?php } } ?>
									  
								</select> 
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Pincode</div>
							<div class="col-lg-9 col-xs-12">
								<input type="text"  value="<?php echo $value->pin_code; ?>"  class="form-control" name="pin_code" autocomplete="off">
							</div>
						</div>
						<div class="col-lg-12 col-xs-12 form-group">
							<div class="col-lg-3 col-xs-12"> Pan Card No.</div>
							<div class="col-lg-9 col-xs-12">
								<input   <?php if($value->pan_no!='' && $value->package_amount>0 ){ echo "readonly"; } ?> type="text" value="<?php echo $value->pan_no; ?>"  class="form-control" name="pan_no" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">  
			<div class="row">  
				<div class="col-lg-6">
					<div class="BankDetails">
						<div class="about-titel " style="width:100%;"> 
							<h3 class="about-company" style="float:none;margin-top:0px;padding-left: 15px;">Bank Details</h3> 
							<div class="aboutcompanyafter" style="margin: 0px auto 25px;"></div> 
						</div> 
						<div class="row">
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> Bank Name</div>
								<div class="col-lg-9 col-xs-12">
									<input   type="text" <?php if($value->bank_name!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->bank_name; ?>"  class="form-control" name="bank_name" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> Account Number</div>
								<div class="col-lg-9 col-xs-12">
									<input   type="text" <?php if($value->account_no!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->account_no; ?>"  class="form-control" name="account_no" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> Branch</div>
								<div class="col-lg-9 col-xs-12">
									<input   type="text" <?php if($value->branch!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->branch; ?>"  class="form-control" name="branch" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> IFSC Code</div>
								<div class="col-lg-9 col-xs-12">
									<input type="text" <?php if($value->ifsc_code!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->ifsc_code; ?>"  class="form-control" name="ifsc_code" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="nomineeDetails">
						<div class="about-titel " style="width:100%;"> 
							<h3 class="about-company" style="float:none;margin-top:0px;padding-left: 15px;">Nominee Details</h3> 
							<div class="aboutcompanyafter" style="margin: 0px auto 25px;"></div> 
						</div>
						<div class="row">
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> Nominee Name</div>
								<div class="col-lg-9 col-xs-12">
									<input type="text" <?php if($value->nominee_name!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->nominee_name; ?>"  class="form-control" name="nominee_name" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-12 col-xs-12 form-group">
								<div class="col-lg-3 col-xs-12"> Relation</div>
								<div class="col-lg-9 col-xs-12">
									<input type="text" <?php if($value->relation!='' && $value->package_amount>0 ){ echo "readonly"; } ?> value="<?php echo $value->relation; ?>"  class="form-control" name="relation" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="col-lg-12" style="clear: both;">
		<input type="submit" value="Update Now"  id="submit_reg_bt" class="btn btn-success btn-custom" />
		<div> &nbsp; </div>
	</div> 
	</div>  
	</div>  
	<?php echo form_close(); ?>   
	</div> 
 
	</div> 
	</div> 
	<style>
		.siplayCls{
			opacity: 1;
		}
		.siplayClsRe{
			opacity: 0;
		}
	</style> 
	<script type="text/javascript">
		getCity('<?php echo $value->state; ?>');  
		function getCity(state_id){  
			selected='<?php echo $value->city; ?>';			 
			$.ajax({
			type: "POST",
			url:  '<?php echo base_url('get-city'); ?>',
			data:{ state_id: state_id,selected:selected },	
			success: function(data){   
					$('#city_id').html(data);
				},
			}); 
		}
	</script> 