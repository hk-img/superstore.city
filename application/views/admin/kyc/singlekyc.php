 <style>
.list-info li label {
    width: 250px;
}

</style>
<section id="content" class="content-container">
	<section class="page-form-ele page">
		<section class="panel panel-default">
			<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>
			<div class="panel-body">
                    <div class="media">
                        <div class="media-body">
							<div class="space"></div>
								<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-kyc'); ?>"><i class="fa fa-eye"></i> Show Kyc</a> 
						</div>
					</div>
				</div>
		</section>
		<section class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <ul class="list-unstyled list-info col-md-6">
								<li>
                                    <span class="fa fa-id-card"></span>
                                    <label>User Name</label>
                                    <?php echo ucwords($result->name);?>
                                </li>
								<li>
                                    <span class="fa fa-picture-o"></span>
                                    <label>Id Proof</label>
									<img src="<?php echo base_url(); ?>web_root/images/kyc_details/<?php echo $result->id_proof; ?>" style="width:100px;height:100px"/>
                                 </li>	
								<li>
                                    <span class="fa fa-picture-o"></span>
                                    <label>Pan Card</label>
									<img src="<?php echo base_url(); ?>web_root/images/kyc_details/<?php echo $result->pan_card; ?>" style="width:100px;height:100px"/>
                                 </li>	
								<li>
                                    <span class="fa fa-picture-o"></span>
                                    <label>Bank Details</label>
                                   <img src="<?php echo base_url(); ?>web_root/images/kyc_details/<?php echo $result->bank_detail; ?>" style="width:100px;height:100px"/>
                                </li>	
								<li>  
									<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url(); ?>admin/Kyc/statuschange/<?php echo $result->member_id; ?>/2"><i class="fa fa-check"></i> Approve Kyc</a> 
									<a class="file-input-wrapper btn btn-default  btn-danger" data-toggle="modal" data-target="#deniedKyc" href="#"><i class="fa fa-trash-o"></i> Denied Kyc</a> 
                                 </li>									
                            </ul>
							<ul class="list-unstyled list-info col-md-6"> 
							 	 
                            </ul>
					   </div>
                    </div>
                </div>
            </div>
			</section>
		</section>
	</section>
			<div id="deniedKyc" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				  <?php 
					$att=array('class'=>'form-horizontal');
					echo form_open('admin/Kyc/Kycdenied'); 
				?>
			   <!-- Modal content-->
				<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Denied Kyc</h4>
					  </div>
					  <div class="modal-body">
							<div class="control-group">
							  <label  >Reason:-</label>	
									<textarea class="form-control" name="reason" required></textarea> 				  
								  <input type="hidden" class="form-control" value="<?php echo $result->member_id; ?>" name="member_id">
								  <input type="hidden" value="3" name="status">
							</div> 
					   </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input id="next" type="submit" class="btn btn-primary" type="submit" value="Denied Kyc" />
					   <?php echo form_close(); ?>   
					  </div>
				</div> 
			   </div>
        </div>