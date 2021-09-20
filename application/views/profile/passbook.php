<?php 
	$data = array(
		'user_id' => $this->session->userdata('userlogin'),
		'status'=>'SUCCESS',
	);
	$result=$this->db->where($data)->order_by('created_date','ASC')->get('str_wallet')->result();
?>
<style>
	label input{ color:black; }	
</style>
<div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-book"></i> Passbook</div>
        <div class="card-body"> 
			<div class="col-md-12 col-xs-12 col-sm-12 ">			
               <table class="table table-bordered" id="passbook" >
					<thead>
						<tr>
							<th>S.R. No.</th>
							<th>Particular</th>
							<th>Main Amount</th>
							<th>Receive Amount</th>
							<th>Admin Charge</th>
							<th>Tds Charge</th>
							<th>Final Amount</th>
							<th>Date & Time</th>
						</tr>
					</thead>
				<?php 
				if(!empty($result)){
				?>
                  <tbody>
                   <?php 	
					$s_no=1;$finalAmount=0;
					foreach($result as $key=>$value)
					{ 		
					
				   ?>
						<tr>
						  <td><?php echo $s_no; ?></td>
						  <td><?php echo $this->Form_model->getParticularName($value->particular_id); ?></td>
							<td><?php echo $value->amount; ?></td>
							<td><?php if($value->type=='dr'){ echo $value->net_amount; }else { echo "0.00"; }?></td>
							<td><?php if($value->type=='dr'){ echo $value->admin_amount; }else { echo "0.00"; }?></td>
							<td><?php if($value->type=='dr'){ echo $value->tds_amount; }else { echo "0.00"; }?></td>
							<td><?php if($value->type=='dr'){ $finalAmount-=($value->amount); }else {  $finalAmount+=($value->amount); } echo number_format($finalAmount,2); ?></td>
							<td ><?php echo $value->created_date; ?></td>
					    </tr>
					   <?php 
					   $s_no++;
					   } 
					   ?>
                   
                  </tbody>
				  <?php }else{ ?>
				    <div class="col-md-12 col-xs-12 col-sm-12 ">
					  <p style="color:red;font-size:25px;text-align:center;">No Result Found</p> 
					</div>
				 <?php  } ?>
                </table>
      </div>
      </div>
      </div>
      </div>
	        
      </div>
      </div>
      </div>
<script>
   $(document).ready(function() {
    $('#passbook').DataTable( {
        "order": [[ 0, "desc" ]]
    });
});
</script>
