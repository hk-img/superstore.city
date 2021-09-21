 
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-search-plus"></i> Update KYC</div>
        <div class="card-body"> 
		<?php
		$att='onsubmit="return checkUniqueIdFun();"';
		 echo form_open_multipart('Profile/UploadKycEnd',$att);
		 ?>
 
            <div class="form-group col-sm-12">
				<div class="col-md-3">
					Id-Proof
				</div>
				<div class="col-md-6">
				  <?php 
					echo form_input(array('type' => 'file', 'name' => 'id_proof','required'=>'required','class'=>'form-control'));
				  ?>
				</div>
				<div class="col-md-3">
					Id-Proof
				</div>
            </div>
            <div class="col-sm-12">
            <div class="col-md-3">
			  Pan Card
						</div>
			<div class="form-group col-md-6">
				<?php 
				echo form_input(array('type' => 'file', 'name' => 'pan_card','required'=>'required','class'=>'form-control')); ?>
			</div>
			  <div class="col-md-3">
				Pan Card
			</div>
            </div>

            <div class="form-group col-sm-12">
				<div class="col-md-3">
					Bank Details
				</div>
				<div class="col-md-6">
					<?php 
					echo form_input(array('type' => 'file', 'name' => 'bank_detail','required'=>'required','class'=>'form-control')); ?>
				</div>
				<div class="col-md-3">
					Bank Details
				</div>
            </div>
			<div class="form-group col-sm-12">
				<div class="col-md-4">
					<img src="<?php echo base_url('web_root/images/kyc_details/mahesh-kumar-bank-details-248750.jpeg'); ?>" class="img-responsive" />
				</div>
				<div class="col-md-4">
					<img src="<?php echo base_url('web_root/images/kyc_details/vijay-agarwal-id-proof-824925.jpg'); ?>" class="img-responsive" />
				</div>
				<div class="col-md-4">
					<img src="<?php echo base_url('web_root/images/kyc_details/vijay-agarwal-pan-card-991492.jpg'); ?>" class="img-responsive" />
				</div>
            </div>
			<div class="form-group col-sm-12">
              <div class="register">
                <button type="submit" class="btn btn-success btn-custom">Submit</button>
              </div>
            </div>		
     <?php echo form_close(); ?>
		 </div>
      </div>
  </div>
  
	<?php $this->load->view('profile/dashboard_rightbar'); ?> 
    
  </div>
</div>
</div>
 