<?php 
	$uniqueId=getUniqueIdById($this->session->userdata('userlogin'));
	$leftChild=getBothleftAndrightChild($uniqueId,'left');
	$rightChild=getBothleftAndrightChild($uniqueId,'right');
    $totalLeftChild=count($leftChild); 
	$totalRightChild=count($rightChild); 
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-support"></i> Downline</div>
				<div class="card-body">  
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
						<h5 style="color:red">Left Users (<?php echo $totalLeftChild; ?>)  </h5>
						<h5 style="color:red">Left Business (<?php  
						 $totalleftBusiness=$this->Form_model->getTotalLeftBusinessVolume($uniqueId,'left'); 
					    echo number_format($totalleftBusiness,2);
						?>) 
					 </h5>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-bordered" id="<?php if(!empty($leftChild)){ echo "example"; } ?>">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>User Name</th>
										<!--<th>Member Name</th>
										<th>Join As</th>
										<th>Registration Date</th>
										<th>Activation Date</th>-->
										<th>Parent Detail</th> 
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=1;
									if(!empty($leftChild))
									{
									foreach($leftChild as $leftChildValue)
									{ 
									
									$result=$this->db->where('unique_id',$leftChildValue[0])->get('str_member')->row();
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result->unique_id; ?></td>
										<!--<td><?php echo $result->name; ?></td>
										<td><?php echo $result->package_amount; ?></td>
										<td><?php echo $result->created_date; ?></td>
										<td><?php echo $result->active_date; ?></td>-->
										<td><?php echo $result->referrer_id; ?></td> 
									</tr>
								<?php $i++; } }else{ ?>
								<tr >
									<td colspan="7">No Result FOUND</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
						<h5 style="color:red">Right Users (<?php echo $totalRightChild; ?>)  </h5>
						<h5 style="color:red">Right Business (<?php   
						$totalleftBusiness=$this->Form_model->getTotalLeftBusinessVolume($uniqueId,'right'); 
					    echo number_format($totalleftBusiness,2);
						?>)  </h5>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;">
						<div class="table-responsive">
							 
							<table class="table table-bordered" id="<?php if(!empty($rightChild)){ echo 'example1'; } ?>">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>User Name</th>
										<!--<th>Member Name</th>
										<th>Join As</th>
										<th>Registration Date</th>
										<th>Activation Date</th>-->
										<th>Parent Detail</th> 
									</tr>
								<thead>
								<tbody>
								<?php 
									$i=1;
									if(!empty($rightChild))
									{
									foreach($rightChild as $rightChildValue)
									{ 
									
									$result=$this->db->where('unique_id',$rightChildValue[0])->get('str_member')->row();
								?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result->unique_id; ?></td>
										<!--<td><?php echo $result->name; ?></td>
										<td><?php echo $result->package_amount; ?></td>
										<td><?php echo $result->created_date; ?></td>
										<td><?php echo $result->active_date; ?></td>-->
										<td><?php echo $result->referrer_id; ?></td> 
									</tr>
								<?php $i++; } }else{ ?>
								<tr >
									<td colspan="7">No Result FOUND</td>
								</tr>
								<?php } ?>
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
    $('#example').DataTable();
} );

$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
 





