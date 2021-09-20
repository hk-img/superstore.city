 <?php  
	$balance=0;
	foreach($result as $key=>$value){}
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-area-chart"></i> Dashboard</div>
        <div class="row card-body">
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('user-profile'); ?>">
          <div class="card text-white o-hidden h-100"style="background: rgba(255,87,34,.6);">
				<div class="card-body">
				  <div class="card-body-icon">
					<i class="fa fa-fw fa-user"></i>
				  </div>
				  <div>My Profile</div>
				</div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a target="_blank" href="<?php echo base_url('registration'); ?>">
          <div class="card text-white o-hidden h-100" style="background: rgba(15,157,88,.6);">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus-circle"></i>
              </div>
              <div>New Advisor</div>
            </div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('genealogy'); ?>">
          <div class="card text-white o-hidden h-100" style="background: rgba(0,150,136,.6);">
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
          <div class="card text-white o-hidden h-100" style="background: rgba(63,81,181,.6);">
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
          <div class="card text-white o-hidden h-100" style="background: rgba(59,89,152,.6);">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
              <div>Direct Team</div>
            </div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('rank-raward'); ?>">
          <div class="card text-white o-hidden h-100" style="background: rgba(219,68,55,.6);">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div>Rank</div>
            </div>
          </div>
		</a>
        </div>
        <div class="col-xl-3 col-sm-6 col-xs-12 mb-3">
		<a href="<?php echo base_url('change-password'); ?>">
          <div class="card text-white o-hidden h-100" style="background: rgba(0,188,212,.6);">
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
          <div class="card text-white o-hidden h-100" style="background: rgba(186,104,200,.6);">
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
					<tr>
					  <td>Repurchase LBV</td>
					  <td><?php echo number_format($this->Form_model->getTotalRepurchaeBv($value->unique_id,'left'),2); ?></td>
					</tr>
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
					<tr>
					  <td>Repurchase RBV</td>
					  <td><?php echo number_format($this->Form_model->getTotalRepurchaeBv($value->unique_id,'right'),2); ?></td>
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


