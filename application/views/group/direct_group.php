  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-users"></i> My Team</div>
				<div class="card-body"> 
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="example" class="table table-bordered">
								<thead>
									<tr>
										<th>Sr No</th>
										<th>User Name</th>
										<th>Name</th>
										<th>Joining Date</th> 
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=1;
										foreach($result as $value)
										{
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $value['unique_id']; ?></td>
											<td><?php echo ucfirst($value['name']); ?></td>											
											<td><?php echo $value['created_date']; ?></td>											
											<td ><?php  echo "Activated"; ?></td>
										</tr>
									<?php $i++; } ?>
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
</script>
