<div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-money"></i> Rewards</div>
				<div class="card-body">
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
						<div class="table-responsive">
							<table id="purchaseList" class="table table-bordered">
								<thead>
								    <tr>
                                        <th>Sr. No.</th>
                                        <th>Order Date</th>
                                        <th>Order Id</th>
                                        <th>Product Name</th>
                                        <th>Amount</th>
                                        <th>Delivery Status</th>
                                        <th>Delivery Date</th>
                                    </tr>
								</thead>
								<tbody>
								    <?php 
								        $i=1;
										
								        foreach($result as $value)
								        {
												$productData=array();
												
												$orderId=createOrderNo($value['purchase_id']);
												
												$productNameArray=explode(',',$value['product_id']);
												$productQtyArray=explode(',',$value['qty']);
												
												$c=0;
												foreach($productNameArray as $productValue)
												{
													$productData[]=getProductName($productValue)."(".$productQtyArray[$c].")";
													$c++;
												}
												
												
								            ?>
											
								                <tr>
								                    <td><?php echo $i; ?></td>
								                    <td><?php echo $value['created_date']; ?></td>
								                    <td><?php echo $orderId; ?></td>
								                    <td><?php echo implode('+',$productData); ?></td>
								                    <td><?php echo $value['dealer_price']; ?></td>
								                    <td>
														<?php 
															if($value['delivery_status']=='1')
															{
																echo "Delivered";
															}
															else
															{
																echo "Pending";
															}
														?>
													</td>
								                    <td>
														<?php 
															if($value['delivery_date']!='' && $value['delivery_status']=='1')
															{
																echo date('Y-m-d H:i:s', strtotime($value['delivery_date']));
															}
															else
															{
																echo "Not Delivered.";
															}
														?>
													</td> 
								                </tr>
                                            <?php
                                            $i++;
								        }
								    ?>
								    
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
        $('#purchaseList').DataTable();
    } );

</script>