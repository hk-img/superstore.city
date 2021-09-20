<?php 
 $root = root();
 $product_id=explode('$$',$result->product_id);
 ?>
 
<section id="content" class="content-container">

<section class="page-form-ele page">

  <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-users'); ?>"><i class="fa fa-eye"></i>  All Users</a>

        </div>

    </section>

<div class="row">

         <div class="col-lg-12">

            <!-- Radio buttons and checkbox -->

            <section class="panel panel-default">

                <div class="panel-heading"><strong>

				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>

                <div class="panel-body" >
					<span id="responsesMsg"></span>
					<div class="col-md-12">	
					 <div class="col-md-12" style="padding-bottom: 20px;box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);border: 1px solid #EDEAE1;padding-top: 20px;margin-bottom: 15px;background: #fff;">	
					<?php echo form_open('#',array('class'=>'ng-pristine ng-valid','name'=>'edit_user','id'=>'edit_user')); ?>
					<div class="form-group col-md-6 paddingZ">
								<div class="col-md-4 paddingZ">
									<label class="" for="exampleInputEmail1">Enter User Name.</label>
								</div>
							<div class="col-md-8">
								<input type="box"   placeholder="Enter User Name." class="form-control" name="name" required value="<?php echo $result->name; ?>"/>
							</div> 
                    </div>
					<div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Enter Mobile No.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Enter Mobile No." class="form-control" name="mobile" value="<?php echo $result->mobile; ?>" required />
						</div> 
                    </div>
					  <div class="clearfix"></div>
					 <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Enter Password.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Enter Password." class="form-control" name="password" value="<?php echo $result->password; ?>" required />
						</div> 
                    </div>
					 <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Email id .</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Email id ." class="form-control" name="email" value="<?php echo $result->email; ?>"  />
						</div> 
                    </div>
					  <div class="clearfix"></div>
					 <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Occupation.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Occupation." class="form-control" name="occupation" value="<?php echo $result->occupation; ?>"  />
						</div> 
                    </div> 
					 <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Pin Code.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Pin Code." class="form-control" name="pin_code" value="<?php echo $result->pin_code; ?>"  />
						</div> 
                    </div> 
				 
					  <div class="clearfix"></div>
					 	 <div class="form-group col-md-12 paddingZ">
							<div class="col-md-2 paddingZ">
								<label class="" for="exampleInputEmail1">Address  .</label>
							</div>
						<div class="col-md-10"> 
							<textarea class="form-control" name="address" ><?php echo $result->address; ?></textarea>
						 </div> 
                    </div>
					 	<!-- <div class="form-group col-md-12 paddingZ">
							<div class="col-md-2 paddingZ">
								<label class="" for="exampleInputEmail1">Products  .</label>
							</div>
						<div class="col-md-10"> 
								<?php
									$query = SelectQuery('*','products','','');	
										foreach($query as $queryKey=>$queryValue){ 
									?>
									<input type="checkbox" name="chkbox[]" value="<?php echo $queryValue->id; ?>" <?php if(in_array($queryValue->id,$product_id)) { echo "checked"; } ?> /> &nbsp<?php echo $queryValue->name; ?>    
								<?php }	
								?>
						 </div> 
                    </div>-->
					  <div class="clearfix"></div>
					<input type="hidden" name="member_id" value="<?php echo $result->member_id; ?>" required />
					 <div class="col-md-6 paddingZ">
							<h4 style="box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);padding: 7px 14px;color: white;width: 100%; float: left; text-align: center; font-size: 24px; border-bottom: 2px solid #767676; background: linear-gradient(120deg,#1486a0 25%,#6e4593 85%);"><i class="fa fa-bank"></i> Bank Details</h4>
					 </div>
					 <div class="col-md-6 paddingZ">
							<h4 style="box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);padding: 7px 14px;color: white;width: 100%; float: left; text-align: center; font-size: 24px; border-bottom: 2px solid #767676; background: linear-gradient(120deg,#1486a0 25%,#6e4593 85%);"><i class="fa fa-users"></i> Nominee Details</h4>
					 </div>
					 <div class="clearfix"></div>
					  <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Bank Name.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Bank Name." class="form-control" name="bank_name" value="<?php echo $result->bank_name; ?>"  />
						</div> 
                    </div>
					 <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Nominee Name.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Nominee Name." class="form-control" name="nominee_name" value="<?php echo $result->nominee_name; ?>"  />
						</div> 
                    </div>
					 <div class="clearfix"></div>
					  <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Account Number.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Account Number." class="form-control" name="account_no" value="<?php echo $result->account_no; ?>"  />
						</div> 
                    </div>
					
					<div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Relation.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Relation." class="form-control" name="relation" value="<?php echo $result->relation; ?>"  />
						</div> 
                    </div>
					 <div class="clearfix"></div>
					  <div class="form-group col-md-6 paddingZ">
							<div class="col-md-4 paddingZ">
								<label class="" for="exampleInputEmail1">Branch.</label>
							</div>
						<div class="col-md-8">
							 <input type="box"    placeholder="Branch." class="form-control" name="branch" value="<?php echo $result->branch; ?>"  />
						</div> 
                    </div>
					 <div class="form-group col-md-12 paddingZ" >
							<div class="col-md-2 paddingZ">
								<label class="" for="exampleInputEmail1">IFSC Code.</label>
							</div>
						<div class="col-md-4">
							 <input type="box"    placeholder="IFSC Code." class="form-control" name="ifsc_code" value="<?php echo $result->ifsc_code; ?>"  />
						</div> 
                    </div>
					<div class="clearfix"></div>
					<button type="submit" class="btn btn-primary btn-w-md">Submit</button>
					
				</div>
				 
		</section>
		<!-- end Radio buttons and checkbox -->            
			</div>
	</div>
    </div>
    </div> 
 </section>
 </section>
 <script>
// 
$(function() {
  $("form[name='edit_user']").validate({
    // Specify validation rules
    rules: {
      name: {
		  required:true, 
	  },  
      password: {
		  required:true, 
	  },  
      mobile: {
		  required:true, 
		  number:true, 
		  minlength:10, 
		  maxlength:10, 
	  },    
     },
    // Specify validation error messages
    messages: 
	{
		name: {
			required:"Please Enter User Name.", 
		},
		password: {
			required:"Please Enter Password.", 
		}, 
		mobile: {
			required:"Please Enter Mobile No.", 
			number:"Please Enter Valid Mobile No.", 
			minlength:"Please Enter Valid Mobile No.", 
			minlength:"Please Enter Valid Mobile No.", 
		}, 
     }, 
    submitHandler: function(form) {
		$("#payroll_loader").css("display", "block");
		$('#responsesMsg').html(''); 
		$.ajax({
			url: "<?php echo base_url('admin/User/editUserEnd'); ?>",
			type: 'post',
			dataType: 'json',
			data: $('form#edit_user').serialize(),
			error: function(){
				$("#payroll_loader").show().fadeOut(500); 
				$('#responsesMsg').html('<div class="callout callout-danger"><p class="ng-binding"><i class="fa fa-times-circle-o"></i> Something wrong.Please Try Again.</p></div>').show().fadeOut(5000); 
			 },
			success: function(data)
			{ 
				if(data.status==1){ 
					$('#responsesMsg').html('<div class="callout callout-info"><p class=pin c"ng-binding"><i class="fa fa-check-circle"></i> '+data.msg+'</p></div>').show().fadeOut(500000000); 
				 }else{
					$('#responsesMsg').html('<div class="callout callout-warning"><p class="ng-binding"><i class="fa fa-times-circle-o"></i> '+data.msg+' </p></div>').show().fadeOut(5000); 
				 }
				  $("#payroll_loader").css("display", "none");
			  }
		});
	
	 return false;
    }
  });
});

</script>



