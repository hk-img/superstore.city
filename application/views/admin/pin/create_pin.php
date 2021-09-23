<?php 
 $root = root();
 ?>
 
<section id="content" class="content-container">

<section class="page-form-ele page">

  <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/all-pin'); ?>"><i class="fa fa-eye"></i>  All Pin</a>

        </div>

    </section>

<div class="row">

         <div class="col-lg-12">

            <!-- Radio buttons and checkbox -->

            <section class="panel panel-default">

                <div class="panel-heading"><strong>

				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>

                <div class="panel-body">
					<span id="responsesMsg"></span>
				   <?php echo form_open('admin/Login/usernamechangeEnd',array('class'=>'ng-pristine ng-valid','name'=>'create_pin','id'=>'create_pin')); ?>
					<div class="form-group">
							<label class="" for="exampleInputEmail1" >Enter Total Pin No.</label><span class="required" style="color:red">*</span>
                            <input type="box"  value="" placeholder="Enter Total Pin No." class="form-control" name="pin_no" required />
                    </div>
					<div class="form-group" style="display:none" >
							<label class="" for="exampleInputEmail1">Enter Pin Amount</label><span class="required" style="color:red">*</span>
							<input type="text" class="form-control" value="2200" placeholder="Enter Pin Amount" onkeypress="return isNumberKey(event)" name="amount" required />
                    </div>
					<div class="form-group" style="display:none">
							<label class="" for="exampleInputEmail1">Enter Business Volume</label><span class="required" style="color:red">*</span>
							<input type="text" value="1000" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter Business Volume" name="business_volume" required  />
                    </div>
					<div class="form-group" style="display:none">
							<label class="" for="exampleInputEmail1">Enter Capping Value</label><span class="required" style="color:red">*</span>
							<input type="text" value="1000" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter Capping Value" name="pv_value" required  />
                    </div>
					<button type="submit" class="btn btn-primary btn-w-md">Submit</button>
				</div>
		</section>
		<!-- end Radio buttons and checkbox -->            
	</div>
    </div>
 </section>
 </section>
 <script>
// 
$(function() {
  $("form[name='create_pin']").validate({
    // Specify validation rules
    rules: {
      pin_no: {
		  required:true,
		  number:true, 
	  },  
      amount: {
		  required:true,
		  number:true, 
	  },
      business_volume: {
		  required:true,
		  number:true, 
	  },
      pv_value: {
		  required:true,
		  number:true, 
	  },    
     },
    // Specify validation error messages
    messages: 
	{
		pin_no: {
			required:"Please Enter Pin No.",
			number:"Please Enter Valid Pin No.",
		},
		amount: {
			required:"Please Enter Pin Amount.",
			number:"Please Enter Valid Pin Amount.",
		},
		business_volume: {
			required:"Please Enter Business Volume.",
			number:"Please Enter Valid Business Volume.",
		},
		pv_value: {
			required:"Please Enter PV Value.",
			number:"Please Enter PV Value.",
		}, 
     }, 
    submitHandler: function(form) {
		$("#payroll_loader").css("display", "block");
		$('#responsesMsg').html(''); 
		$.ajax({
			url: "<?php echo base_url('admin/Pin/createPinEnd'); ?>",
			type: 'post',
			dataType: 'json',
			data: $('form#create_pin').serialize(),
			error: function(){
				$("#payroll_loader").show().fadeOut(500); 
				$('#responsesMsg').html('<div class="callout callout-danger"><p class="ng-binding"><i class="fa fa-times-circle-o"></i> Something wrong.Please Try Again.</p></div>').show().fadeOut(5000); 
			 },
			success: function(data)
			{ 
				if(data.status==1){
					$('form#create_pin')[0].reset();
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



