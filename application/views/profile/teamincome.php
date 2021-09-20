<?php 
    $unique_id=getUniqueIdById($this->session->userdata('userlogin'));
     $leftChild=getBothleftAndrightChild($unique_id,'left');
	  $rightChild=getBothleftAndrightChild($unique_id,'right');
	  
	  $$childArray=array();
	  $fianlChild=array_merge($leftChild,$rightChild);
	  
	   if(!empty($fianlChild))
	   {
	       foreach($fianlChild as $fianlChildValue)
	        {
	            $childArray[]=$fianlChildValue[0];
	        }
	   }
?> 
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-money"></i> Total Team</div>
				<div class="card-body">
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
						<div class="table-responsive">
							<table class="table table-bordered" id="example1">
								<thead>
								    <tr>
                                        <th>Sr. No.</th>
                                        <th>Advisor Id</th>
                                        <th>Sponsor Id</th>
                                         <th>Status</th>
                                         <th>Activation date</th>
                                        <!--<th>Binary Income</th> -->
                                        <!--<th>Total Income</th>-->
                                         <!--<th>Tds</th>-->
                                        <!-- <th>Admin Charge</th>-->
                                        <!-- <th>Net Total</th>-->
                                    </tr>
								</thead>
								<tbody>
								    <?php
								        if(!empty($childArray))
								        {
								            $i=1;
								           foreach($childArray as $childArrayValue)
								           {
								    ?>
							        <tr>
                                        <th><?php echo $i; ?></th>
                                        <th><?php echo $childArrayValue; ?></th>
                                        <!-- <th>
                                        <?php 
                                            $userId=getIdByUniqueId($childArrayValue);
                                            echo totalBinaryIncome($userId);
                                        ?>    
                                        </th> -->
                                        <!-- <th><?php echo $this->Form_model->totalGrossBalance($userId);  ?></th>-->
                                        <!-- <th><?php echo totalUserTds($userId); ?></th>-->
                                        <!-- <th><?php echo totalUserAdminCharge($userId);  ?></th>-->
                                        <!-- <th>
                                        <?php 
                                             
                                           echo $this->Form_model->totalCrBalance($userId);
                                        ?>
                                        </th>-->
                                        <th><?php echo $this->db->where('unique_id',$childArrayValue)->get('str_member')->row()->referrer_id ?></th>
                                        <th>
                                        <?php  
                                            $packageAmount=getPackageAmtByUniqueId($childArrayValue);
                                            if($packageAmount>'0'){ echo "Activate"; }else { echo "Pending"; } 
                                        ?>    
                                        </th>
                                        <th><?php if($packageAmount>0){ echo $this->db->where('unique_id',$childArrayValue)->get('str_member')->row()->active_date; }else{ echo '0000-00-00 00:00:00'; } ?></th>
                                    </tr>
                                    <?php  $i++; } } ?>
							    </tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    
  </div>
</div>
</div>

 <script>
  
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script> 







