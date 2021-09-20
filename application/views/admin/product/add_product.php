<?php 
	$id='';$name='';$image_name='';$description='';$price='';$service_tax='';$business_volume='';$dealer_price='';
	
	if(!empty($result))
	{
		$id=$result->id;
		$name=$result->name;
		$image_name=$result->image_name;
		$description=$result->description;
		$business_volume=$result->business_volume;
		$price=$result->price;
		$service_tax=$result->service_tax; 
		$dealer_price=$result->dealer_price; 
	}
?>

<section id="content" class="content-container">
	<section class="page-form-ele page">
		<section class="panel panel-default">
			<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>
			<div class="panel-body">
				<div class="space"></div>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-product'); ?>"><i class="fa fa-eye"></i>  Show Product</a>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-repurchase-product'); ?>"><i class="fa fa-eye"></i>  Repurchase Product</a>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-repurchase-bonus'); ?>"><i class="fa fa-eye"></i>  Repurchase Bonus</a>
			</div>
		</section>
		<div class="row">
			<div class="col-lg-12">
				<!-- Radio buttons and checkbox -->
				<section class="panel panel-default">
					<div class="panel-heading"><strong>
						<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong>
					</div>
					<div class="panel-body" >
						<span id="responsesMsg"></span>
						<div class="col-md-12">	
							<?php 
								echo form_open_multipart('admin/Product/AddProductEnd',array('class'=>'ng-pristine ng-valid'));
							?>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Enter Name.</label>
								</div>
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<div class="col-md-10">
									<input type="box"   placeholder="Enter User Name." class="form-control" name="name" required value="<?php echo $name; ?>"/>
								</div> 
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Upload Product Image.</label>
								</div>
								<input type="hidden" name="image" value="<?php echo $image_name; ?>" />
								<div class="col-md-4">
									<input type="file"  name="image_name"  value="<?php echo $name; ?>"/>
								</div> 
								<?php if($image_name!='')
								{
								?> 
								<div class="col-md-4">
									<img src="<?php echo base_url(); ?>web_root/images/product_image/<?php echo $image_name; ?>" style="height:100px;width:100px" />
								</div> 
								<?php } ?>
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Description</label>
								</div>
								<div class="col-md-10">
									<textarea name="description" placeholder="Please Enter Description" class="form-control ckeditor" required="required"><?php echo $description; ?></textarea>
								</div> 
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Price</label>
								</div>
								<div class="col-md-10">
									<input type="box"  onkeypress="return isNumberKey(event)"  placeholder="Price." class="form-control" name="price" required value="<?php echo $price; ?>"/>
								</div> 
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">DP</label>
								</div>
								<div class="col-md-10">
									<input type="box"  onkeypress="return isNumberKey(event)" placeholder="Dealer Price" class="form-control" name="dealer_price" required value="<?php echo $dealer_price; ?>"/>
								</div> 
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Service tax (in %)</label>
								</div>
								<div class="col-md-10">
									<input type="box"   onkeypress="return isNumberKey(event)" placeholder="Service tax (in %)" class="form-control" name="service_tax" required value="<?php echo $service_tax; ?>"/>
								</div> 
							</div>
							<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Business Volume</label>
								</div>
								<div class="col-md-10">
									<input type="box"  onkeypress="return isNumberKey(event)" placeholder="Business Volume" class="form-control" name="business_volume" required value="<?php echo $business_volume; ?>"/>
								</div> 
							</div>
							<button type="submit" class="btn btn-primary btn-w-md">Submit</button>
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
     },
    // Specify validation error messages
    messages: 
	{
		name: {
			required:"Please Enter Name.", 
		}, 
     }, 
    submitHandler: function(form) {
		$("#payroll_loader").css("display", "block");
		$('#responsesMsg').html(''); 
		$.ajax({
			url: "<?php echo base_url('admin/Achiver/addachiverEnd'); ?>",
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
					$('#responsesMsg').html('<div class="callout callout-info"><p class="ng-binding"><i class="fa fa-check-circle"></i> '+data.msg+'</p></div>').show().fadeOut(500000000); 
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



