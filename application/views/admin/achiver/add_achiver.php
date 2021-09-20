<?php 
	
	
	$id='';$name='';
	if(!empty($result))
	{
		$id=$result->id;
		$name=$result->name;
	}
?>
<section id="content" class="content-container">

<section class="page-form-ele page">

  <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-achiver'); ?>"><i class="fa fa-eye"></i>  Show Achiever</a>

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
					<?php echo form_open('#',array('class'=>'ng-pristine ng-valid','name'=>'edit_user','id'=>'edit_user')); ?>
					<div class="form-group col-md-12 paddingZ">
								<div class="col-md-2 paddingZ">
									<label class="" for="exampleInputEmail1">Enter Name.</label>
								</div>
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<div class="col-md-10">
								<input type="box"   placeholder="Enter User Name." class="form-control" name="name" required value="<?php echo $name; ?>"/>
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



