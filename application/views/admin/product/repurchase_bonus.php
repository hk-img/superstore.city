 
<section id="content" class="content-container">
<section class="page-form-ele page">

   <section class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>
        <div class="panel-body">
			<div class="space"></div>
            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/add-product'); ?>"><i class="fa fa-plus"></i>  Add Product</a>
            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-product'); ?>"><i class="fa fa-eye"></i>  Show Product</a>
            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-repurchase-product'); ?>"><i class="fa fa-eye"></i>  Repurchase Product</a>
        </div>
    </section>
	 <div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>
 

			  <div class="panel-body">
                    <div class="table-responsive">
                <table id="allUser" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> S.No</th>
                            <th> User Name</th>
                            <th> Month Duration</th>
                            <th> Bonus Amount</th>
                            <th> Status</th>
                            <th> Delivery Date</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php  
							if(!empty($result))
							{
								$s_no=1;
								
								foreach($result as $resultValue)
								{
						  ?>
									<tr>
										<td><?php echo $s_no;?></td>
										<td><?php echo getNameByMemberId($resultValue['user_id']);?></td>
										<td><?php echo $resultValue['bonus_enddate']." to ".$resultValue['bonus_startdate']; ?></td>
										<td><?php echo number_format($resultValue['amount'],2); ?></td>
										<td>
											<?php 
												if($resultValue['delivered_status']=='1')
												{
													echo "<span class='label label-success'>Delivered</span>";
												}
												else
												{
													echo "<span class='label label-danger'>Pending</span>";
												}
											?>
										</td>
										<td>
											<?php 
												if($resultValue['delivered_date']!='' && $resultValue['delivered_status']=='1')
												{
													echo date('Y-m-d H:i:s', strtotime($resultValue['delivered_date']));
												}
												else
												{
													echo "Not Delivered.";
												}
											 ?>
										 </td>
										<td>
											<?php 
												$status=0;
												
												if($resultValue['delivered_status']=='0')
												{
													$status=1;
												}
											?>
											<a  onclick="return confirm('Are You Sure ? You want to change product delivery status.')"  href="<?php echo base_url(); ?>admin/Product/changeBonusDeliveryStatus/<?php echo $resultValue['bonus_id']."/".$status; ?>"><span class='label label-success'><i class='fa fa-check'></i> Change status</span></a>
										</td>
									</tr>
					<?php $s_no++; }  } ?>
                   </tbody>
                </table>
   </div>
                </div>
            </section>

            <!-- end Radio buttons and checkbox -->            
        </div>
    </div>
</section>
</section>
<script> 

	$(document).ready(function() {
		$('#allUser').DataTable(
		{
			 "pageLength": 50,
			 "scrollX": true
		});
	} );
</script>
