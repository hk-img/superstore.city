 
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet" />  
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />  
 

 
  <style>
	td.details-control {
    background: url('./web_root/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('./web_root/images/details_close.png') no-repeat center center;
}
 </style>
 
    <section class="bg-white" id="about-us" style="margin:auto;">
      <div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12 paddingZ table-responsive">
		
				<table id="reward" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr> 
							<th>S.No.</th>
							<th>Reward</th>
							<th>Amount</th>
							<th>On Date and time</th> 
						</tr>
					</thead> 
					<tbody>
						<?php 
							$sNo=1;
							foreach($result as $key=>$value)
							{
						?>
						<tr>
							<td><?php echo $sNo; ?></td>
							<td><?php echo ucfirst($value->reward_type); ?></td>
							<td><?php echo $value->amount; ?></td>
							<td><?php echo $value->created_date; ?></td> 
						</tr> 
							<?php $sNo++; } ?>
					</tbody>
				</table>      
          </div>
        </div>
      </div>
    </section>

<script src="https://code.jquery.com/jquery-1.12.4.js" ></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" ></script>		  


<script>
	$(document).ready(function() {
		$('#reward').DataTable();
	} );
</script>