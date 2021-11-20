 <?php  
	$balance=0;
	foreach($result as $key=>$value){}
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-area-chart"></i> Dashboard</div>
        <div class="row card-body">
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('user-profile'); ?>">
          <div class="card text-white o-hidden h-100"style="background-image: linear-gradient(to left, #0db2de 0%, #005bea 100%) !important;">
				<div class="card-body">
				  <div class="card-body-icon">
					<i class="fa fa-fw fa-user"></i>
				  </div>
				  <div>My Profile</div>
				</div>
          </div>
		</a>
        </div>
		<!--
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a target="_blank" href="<?php echo base_url('registration'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(45deg, #f93a5a, #f7778c) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus-circle"></i>
              </div>
              <div>New Advisor</div>
            </div>
          </div>
		</a>
        </div>
		-->
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('genealogy'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(to left, #48d6a8 0%, #029666 100%) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-tree"></i>
              </div>
              <div>User View</div>
            </div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('downline'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(to left, #efa65f, #f76a2d) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div>Total Users</div>
            </div>
          </div>
		</a>
        </div>
		<div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('my-team'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(to left, #efa65f, #f76a2d) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
              <div>Direct Team</div>
            </div>
          </div>
		</a>
        </div>
		<!--
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('rank-raward'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(to left, #48d6a8 0%, #029666 100%) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div>Rank</div>
            </div>
          </div>
		</a>
        </div>
		-->
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('change-password'); ?>">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(45deg, #f93a5a, #f7778c) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-key"></i>
              </div>
              <div>Change Password</div>
            </div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;">
          <div class="card text-white o-hidden h-100" style="background-image: linear-gradient(to left, #0db2de 0%, #005bea 100%) !important;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-power-off"></i>
              </div>
              <div>Logout</div>
            </div>
          </div>
		</a>
        </div>
        </div>
      </div>
	  </div>
	  
    <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
	  <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Business Details</div>
        <div class=" row card-body">
			<div class="col-lg-6 col-xs-12 pull-left">
			  <div class="table-responsive">
				<table class="table table-bordered">
				  <tbody>
					<!--<tr>
					  <td>Left User Name</td>
					  <td>
					  <?php 
							$treeResult=$this->db->where('unique_id',$value->unique_id)->get('str_binarytree')->row();
							if(!empty($treeResult))
							{
								echo getNameIdByUniqueId($treeResult->left);
							}
							else
							{
								echo "N/A";
							}
						?>
					  </td>
					</tr>-->
					<tr>
					  <td>Total LBV</td>
					  <td><?php  $totalleftBusiness=$this->Form_model->getTotalLeftBusinessVolume($value->unique_id,'left'); 
					  
					    echo number_format($totalleftBusiness,2);
					  ?></td>
					</tr>
					<tr>
					  <td>Current LBV</td>
					 <!-- <td><?php echo number_format($this->db->select('carry_leftpv as total')->order_by('income_id','desc')->limit(1)->where('user_id',$value->member_id)->get('str_userincome')->row()->total,2); ?></td>-->
					 <td>
					    <?php 
					         $leftrightBusiness=$this->db->select('SUM(net_pairs) as total')->where('user_id',$value->member_id)->get('str_userincome')->row()->total;
					         $leftFinalAmount=$totalleftBusiness-$leftrightBusiness;
					        echo number_format($leftFinalAmount,2);
					    ?> 
					     
					 </td>
					</tr>
					<tr>
					  <td>Paid BV</td>
					  <td><?php echo number_format($leftrightBusiness,2); ?></td>
					</tr>
					<!--
					<tr>
					  <td>Repurchase LBV</td>
					  <td><?php echo number_format($this->Form_model->getTotalRepurchaeBv($value->unique_id,'left'),2); ?></td>
					</tr>
					-->
				  </tbody>
				</table>
			  </div>
			</div>
			<div class="col-lg-6 col-xs-12 pull-left">
			  <div class="table-responsive">
				<table class="table table-bordered" widtd="50%">
				  <tbody>
					<!--<tr>
					  <td>Right User Name</td>
					  <td>
						<?php 
							if(!empty($treeResult))
							{
								echo getNameIdByUniqueId($treeResult->right);
							}
							else
							{
								echo "N/A";
							}
						?>
					  </td>
					</tr>-->
					<tr>
					  <td>Total RBV</td>
					  <td><?php  $totalRightBusiness=$this->Form_model->getTotalLeftBusinessVolume($value->unique_id,'right'); 
					  
					  echo number_format($totalRightBusiness,2);
					  ?></td>
					</tr>
					<tr>
					  <td>Current RBV</td>
					 <!-- <td><?php echo number_format($this->db->select('carry_rightpv as total')->order_by('income_id','desc')->limit(1)->where('user_id',$value->member_id)->get('str_userincome')->row()->total,2); ?></td>-->
					 <td>
					     <?php 
					       
					       $totaLCurrentRightBusine=$this->db->select('SUM(net_pairs) as total')->where('user_id',$value->member_id)->get('str_userincome')->row()->total;
					       $rightFinalAmount=$totalRightBusiness-$totaLCurrentRightBusine;
					     echo number_format($rightFinalAmount,2);
					     ?>					     
					 </td>
					</tr>
					<tr>
					  <td>Paid BV</td>
					  <td><?php echo number_format($totaLCurrentRightBusine,2); ?></td>
					</tr>
					<!--
					<tr>
					  <td>Repurchase RBV</td>
					  <td><?php echo number_format($this->Form_model->getTotalRepurchaeBv($value->unique_id,'right'),2); ?></td>
					</tr>
					-->
				  </tbody>
				</table>
			  </div>
			</div>
      </div>
         
        </div>
        </div>
	<div class="col-lg-3 col-xs-12">
        <!-- Example Wallet Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-credit-card"></i> Wallet Status
              <span style="float:right;cursor:pointer" onclick="withdrawlWindow()" ><i class="fa fa-inr"></i> Withdrawl</span>
		  </div>
            <div class="list-group list-group-flush small">
                 <p><span>(5% TDS &amp; 10% admin charge deducted)</span></p>
              <p>Wallet Balance - <i class="fa fa-inr" style="font-size: 13px;"></i>
		      <?php     
					$totalCrBalance=$this->Form_model->totalGrossBalance($this->session->userdata('userlogin')); 
					
					$confirmBalanceBalance=$this->Form_model->confirmGrossBalance($this->session->userdata('userlogin'));
					
					$confirmPendingBalance=$this->Form_model->confirmPendingBalance($this->session->userdata('userlogin'));
					
					echo number_format(($totalCrBalance-($confirmBalanceBalance+$confirmPendingBalance)),2);
					$finalBalance=($totalCrBalance-($confirmBalanceBalance+$confirmPendingBalance));
				?>
			  </p>		  
			   <p>Pending Amount - <i class="fa fa-inr" style="font-size: 13px;"></i> <?php echo number_format($confirmPendingBalance,2); ?></p>
			  <p>Confirm Amount - <i class="fa fa-inr" style="font-size: 13px;"></i> <?php echo number_format($confirmBalanceBalance,2); ?></p>
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
		</div>
		
		<div class="col-lg-3 col-xs-12">
          <div class="card mb-3 ">
            <div class="card-header">
              <i class="fa fa-file-text-o"></i> Member News</div>
            <div class="card-body">
				<marquee onmouseover="stop();" onmouseout="start();" scrollamount="3" direction="up" style="height:250px;">
					<?php 
						$news=$this->db->get('news')->result();
						 
						if(!empty($news))
						{
							foreach($news as $newsValue)
							{
								?>
									<div class="new-update" style="border-bottom:1px dotted #FD3F2A;">
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
        </div>
      </div>
      
    </div>
    </div>


