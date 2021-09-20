<?php 
$root = root();
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-key"></i> Change Password</div>
        <div class="card-body">       
		<?php
			echo form_open_multipart('Profile/changePasswordEnd');
		?>
		<div class="row">
			<div class="col-lg-12 col-xs-12 form-group">
				<div class="col-lg-3 col-xs-12">Old Password</div>
				<div class="col-lg-9 col-xs-12">
					<input  type="text"  value=""  class="form-control" name="o_pass" required="required">
				</div>
			</div>
			<div class="col-lg-12 col-xs-12 form-group">
				<div class="col-lg-3 col-xs-12">New Password</div>
				<div class="col-lg-9 col-xs-12">
					<input  type="text"  value=""  class="form-control" name="n_pass" required="required">
				</div>
			</div>
			<div class="col-lg-12 col-xs-12 form-group">
				<div class="col-lg-3 col-xs-12">Confirm Password</div>
				<div class="col-lg-9 col-xs-12">
					<input  type="text"  value=""  class="form-control" name="c_pass" required="required">
				</div>
			</div>
			<div class="col-lg-12 col-xs-12 form-group">
				<input type="submit" style="float:right;"name="btnsave" value="Change Password"  id="submit_reg_bt" class="btn btn-success" />
			</div>
			<div>   
				<input type="hidden" name="HfPageOpt" id="HfPageOpt" value="4" /> 
				<div> &nbsp; </div>
			</div>
		</div>

<?php echo form_close(); ?>

            </div>
          </div>
		       
        </div>
        <?php $this->load->view('profile/dashboard_rightbar'); ?> 
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
var root5='<?php echo $root; ?>';
	function checkUniqueIdFun(){
		var Unique_id=$('#unique_id').val();
		if(Unique_id !=''){
		// alert(Unique_id);
		$.ajax({
				type: "POST",
				url: root5+'/Registration/CheckUserIdAjax',
				data:{Unique_id1: Unique_id},	
				success: function(data){
						// alert(data);
						if(data !=''){
							$('#details_parent').html(data);
							document.getElementById('valid_id').style.display="block";
							document.getElementById('invalid_id').style.display="none";
							$('#submit_reg_bt').attr('disabled', false);
							// return true;
						}else{
							$('#details_parent').html('');
								document.getElementById('valid_id').style.display="none";
							document.getElementById('invalid_id').style.display="block";
							$('#submit_reg_bt').attr('disabled', 'disabled');
							// return false;
						}
					},
				});
	}
	}
	Sponser_id_fun('no');
function Sponser_id_fun(value_id){
	// alert(value_id);
	if(value_id == "yes"){
		// document.getElementById('sponser_id_div').style.display="block";
		$('#sponser_id_div').removeClass( "siplayClsRe" );
		 $('#sponser_id_div').addClass( "siplayCls" );

	
		// $('#unique_id').attr('required', true);
		$("#unique_id").attr('required', '');
	}else{
		// document.getElementById('sponser_id_div').style.display="none";
		 $('#sponser_id_div').removeClass( "siplayCls" );
 $('#sponser_id_div').addClass( "siplayClsRe" );
		$("#unique_id").removeAttr('required'); 
	}
}

</script>
<script>
function checkUser_id(){
	// alert('aa');
	// return false;
}
</script>