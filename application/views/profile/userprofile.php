 <?php  
	$balance=0; 
	foreach($result as $key=>$value){}

?>


  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-xs-12">
      <div class="card mb-3">
        <div class="card-header">
			<i class="fa fa-tasks"></i> Profile Status
			<a href="<?php echo base_url('edit-profile'); ?>"><span style="float:right;color:#fff"><i class="fa fa-edit"></i> Edit Profile</span></a>
		</div>
        <div class="row card-body">
			   <div class="list-group list-group-flush small" style="width:100%;">
              <div class="table-responsive">
				<table class="table">
				  <tbody>
					<tr>
					  <td style="border-top: none;">Last Login</td>
					  <td style="border-top: none;"><?php echo date("d-M-Y H:i:s", strtotime($value->last_login)); ?></td>
					</tr>
					<tr>
					  <td>Joining Date</td>
					  <td><?php echo date("d-M-Y", strtotime($value->created_date)); ?></td>
					</tr>
					<tr>
					  <td>Join As</td>
					  <td><?php echo number_format($value->package_amount); ?></td>
					</tr>
					<tr>
					  <td>Activate Date</td>
					  <td><?php echo date("d/M/Y", strtotime($value->created_date)); ?></td>
					</tr>
					<tr>
					  <td>Status</td>
					  <td>Active</td>
					</tr>
					<tr>
					  <td>User Name</td>
					  <td><?php echo $value->unique_id; ?></td>
					</tr>
					<tr>
					  <td>Member Name</td>
					  <td><?php echo getNameIdByUniqueId($value->unique_id); ?></td>
					</tr>
					<tr>
					  <td>Sponser User Name</td>
					  <td><?php echo $value->referrer_id; ?></td>
					</tr>
					<tr>
					  <td>KYC Status</td>
					  <td>
						<?php 
							if($resultValue->kyc_upadte=='2')
							{
								echo "KYC Approved";
							}
							elseif($resultValue->kyc_upadte == 3)
							{
								echo "KYC Rejectd";
							}
							else
							{
								echo "Not Updated yet";
							}
						?>
					  </td>
					</tr>
					<tr>
					  <td>Contact No.</td>
					  <td><?php echo $value->mobile;?></td>
					</tr>
					<tr>
					  <td>Email Id</td>
					  <td><?php echo $value->email;?></td>
					</tr>
				  </tbody>
				</table>
			  </div>
            </div>
        </div>
      </div>

        </div>

			<?php $this->load->view('profile/dashboard_rightbar'); ?>  
		</div>      
    </div>
    </div>


