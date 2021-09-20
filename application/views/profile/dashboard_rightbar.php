	<div class="col-lg-4 col-xs-12">
        <!-- Example Wallet Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-credit-card"></i> Wallet Status
              <span style="float:right;cursor:pointer" onclick="withdrawlWindow()" ><i class="fa fa-inr"></i> Withdrawl</span>
		  </div>
            <div class="list-group list-group-flush small">
                 <p><span style="font-size: 11px;margin: 0px;padding: 0px;">(5% TDS &amp; 10% admin charge deducted)</span></p>
              <p style="font-size: 14px;margin-bottom: 0;">Wallet Balance - <i class="fa fa-inr" style="font-size: 13px;"></i>
		      <?php     
					$totalCrBalance=$this->Form_model->totalGrossBalance($this->session->userdata('userlogin')); 
					
					$confirmBalanceBalance=$this->Form_model->confirmGrossBalance($this->session->userdata('userlogin'));
					
					$confirmPendingBalance=$this->Form_model->confirmPendingBalance($this->session->userdata('userlogin'));
					
					echo number_format(($totalCrBalance-($confirmBalanceBalance+$confirmPendingBalance)),2);
					$finalBalance=($totalCrBalance-($confirmBalanceBalance+$confirmPendingBalance));
				?>
			  </p>		  
			   <p style="padding-top: 10px;font-size: 14px;margin-bottom: 0;">Pending Amount - <i class="fa fa-inr" style="font-size: 13px;"></i> <?php echo number_format($confirmPendingBalance,2); ?></p>
			  <p style="padding-top: 10px;font-size: 14px;margin-bottom: 0;">Confirm Amount - <i class="fa fa-inr" style="font-size: 13px;"></i> <?php echo number_format($confirmBalanceBalance,2); ?></p>
			  <!--<p style="padding-top: 10px;font-size: 14px;margin-bottom: 0;">REF. Amount - <i class="fa fa-inr" style="font-size: 13px;"></i> 
			  <?php 
			  
				$oldroiAmount=$this->db->select('SUM(reward_amount) as total')->where(array('user_id'=>$this->session->userdata('userlogin'),'date(created_date)<='=>'2018-08-30'))->get('str_directincome')->row();
				
				$newRoiAmount=$this->db->select('SUM(reward_amount) as total')->where(array('user_id'=>$this->session->userdata('userlogin'),'date(created_date)>'=>'2018-08-30'))->get('str_directincome')->row();
				
				$oldRoAmount=(int) (($oldroiAmount->total)*12); 
				$newRoiAmount=(int) $newRoiAmount->total; 

				echo number_format((($oldRoAmount+$newRoiAmount)),2);				
				?>
				</p>-->
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-file-text-o"></i> Member News</div>
            <div class="card-body">
				<marquee onmouseover="stop();" onmouseout="start();" scrollamount="3" direction="up" style="padding:12px;height:190px;">
					<?php 
						$news=$this->db->get('news')->result();
						 
						if(!empty($news))
						{
							foreach($news as $newsValue)
							{
								?>
									<div style="border-bottom:1px dotted #FD3F2A;">
										<p><br><?php echo ucfirst($newsValue->name); ?>.</p>
										<?php 
											if($newsValue->image_name!='')
											{
										?>
										<p><br><img class="img-responsive" src="<?php echo base_url(); ?>web_root/admin_root/img/<?php echo $newsValue->image_name; ?>" /></p>
										<?php } ?>
									</div> 
								<?php 
							}
						}
						else
						{
							?>
							<div style="border-bottom:1px dotted #FD3F2A;">
								<p><br>Welcome in AYRGROUP.</p>
							</div> 
							<?php 
						}
					 ?>
					
				</marquee>
            </div>
          </div>
          <!-- Example Notifications Card-->
	</div>
	
	<!--WITHDRAWL MODAL WINDOW-->
	
	<div class="modal fade" id="withdrawl" role="dialog">
		<div class="modal-dialog modal-md">
		  <div class="modal-content" style="color: #333;">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h5 class="modal-title">Withdrawl Amount</h5>
			</div>
			<div class="modal-body">
			  <form action="<?php echo base_url(); ?>Profile/withdrwlAmount" id="formId" method="post">
			     <input type="hidden" name="balance" value="<?php echo $finalBalance; ?>" />
				<p style="color:red">The amount should be less than your actual amount. </p>
				<input type="number" required class="form-control" name="amount" placeholder="Please Enter Withdrwal Amount" />
				<p style="color:red;margin-top: 8px;">OTP sent your Registered E-mail Id.Please Enter </p>
				<input type="number" required class="form-control" name="otp" placeholder="OTP" />
			</div>
			<div class="modal-footer">
			  <button type="submit" class="btn btn-secondary" >Submit</button>
			  <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
			</div>
			</form>
		  </div>
		</div>
	</div>

<script>
	function withdrawlWindow()
	{
		 
		$.ajax({
			type: "POST",
			dataType : "json",
			url:  "<?php echo base_url(); ?>Profile/withdrawlWindow",
			success: function(data) {
				if(data.status=='1')
				{
					$('#withdrawl').modal('show');
				}
				else
				{
					location.reload();
				}
			},
		});
	}
</script>	