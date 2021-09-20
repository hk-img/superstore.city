 <link href="<?php echo base_url(); ?>web_root/fSelect.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>web_root/fSelect.js"></script>
<style>
 	.siplayCls{
 		opacity: 1;
 	}
 	.siplayClsRe{
 		opacity: 0;
 	}
	.fs-wrap.multiple{
		width: 100%;
		height: 34px;
		font-size: 14px;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 3px;
	}
	.fs-label-wrap{border: none;}
	.fs-label-wrap .fs-label {
		padding: 8px 22px 0px 8px;
	}
	.fs-arrow {top: 8px;}
	.fs-dropdown { width: 566px;}
	 
</style>
<script>
(function($) {
    $(function() {
        $('.product').fSelect(); 
    });
})(jQuery);
</script>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="card mb-3">
					<div class="card-header"><i class="fa fa-shopping-cart"></i> Repurchase Product</div>
					<div class="card-body"> 	
						<?php 
							echo form_open_multipart(root()."repurchase-product");
							
							echo validation_errors();
						?>  
						<table class="personal-detailsTable" width="100%">
							<tbody>
								<tr>
									<td valign="top" width="100%">
										<table width="100%" style="line-height:50px;">
											<tbody>
												<tr>
													<td style="width:22%">Select Product Name</td>
													<td> 
														<select multiple="multiple" class="product" onchange="getProductHtml()" id="select_product"   class="form-control" name="product_id[]"  >
															<?php  
																if(!empty($product_list))
																{
																	foreach($product_list as $product_listValue)
																	{ 
																		$selectedProductResult=set_value('product_id');
																		 
																	?>
																		<option <?php if(in_array($product_listValue['id'],$selectedProductResult)){ echo 'selected'; } ?> value="<?php echo $product_listValue['id']; ?>"><?php echo ucfirst($product_listValue['name']); ?></option>
																	<?php 
																	}
																}
																else
																{
																	echo "<option value=''>No Product Found</option>";
																}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td>Product Detail</td>
													<td>
														<table class="table table-bordered">
															<tr>
																<th style="width:9%;text-align: center;">S.No.</th>
																<th style="text-align: center;">Product Name.</th>
																<th style="width: 14%;text-align: center;">Price.</th>
																<th style="width: 14%;text-align: center;" >D.P.</th>
																<th style="width: 14%;text-align: center;">B.V.</th>
																<th style="width:12%;text-align: center;">Qty.</th>
															</tr>
															<tbody id="tableHtml">
																<!--Ajax Content Here-->
															</tbody>
														</table>
													</td>
												</tr>
												      <tr>
                                                        <td>Amount</td>
                                                        <td>
                                                            <table class="table table-bordered" style="margin-top:30px">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="text-align:center">Price</th>
                                                                        <th style="text-align:center">D.P.</th>
                                                                        <th style="text-align:center">B.V.</th>
                                                                        <th style="text-align:center">E-PIN</th>
                                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" style="text-align:center" readonly placeholder="Amount" id="amount" required name="amount" value="<?php if(set_value('amount')==''){ echo set_value('amount'); }else{ echo '0.00'; } ?>" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" style="text-align:center" readonly placeholder="Dealer Price" id="dealer_price" required name="dealer_price" value="<?php if(set_value('dealer_price')==''){ echo set_value('dealer_price'); }else{ echo '0.00'; } ?>" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" style="text-align:center" readonly placeholder="Business Volume" id="business_volume" required name="business_volume" value="<?php if(set_value('business_volume')==''){ echo set_value('business_volume'); }else{ echo '0.00'; } ?>" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" style="text-align:center" placeholder="E-PIN" required name="pin" value="<?php echo set_value('pin'); ?>" class="form-control">
                                                  </td>
												  </tr>
												  
												   </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-success" style="margin-top:15px" id="" name="upgrade" value="upgrade" style="margin-bottom:20px;">Submit</button>
                                 	 
                                                   
                                                    </td>
												
                                          
								   </tr>
								          
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>


						<div>   
						</div>
					</div>

					<?php echo form_close(); ?>
				</div>
			</div>
			<?php $this->load->view('profile/dashboard_rightbar'); ?>
		</div>
	</div>
</div>

<script>

	function getProductHtml()
	{
		productId=$('#select_product').val(); 
		allQty=$('.qtyValue').map(function() {return this.value;}).get().join(',');

		if(productId!='')
		{  
			 $.ajax({
				url: "<?php echo base_url(); ?>Product/getProductHtml",
				dataType: 'json',
				data: { productId:productId,allQty:allQty},
				type: 'post', 
				error: function(){ 
					alert('Something Wrong.Please Try Again');				  
				},
				success: function(data)
				{    
					$('#tableHtml').html(data.tableHtml);
					
					getProductAmount();
				}
			});
		}
	}
	
	function getProductAmount()
	{
		allQty=$('.qtyValue').map(function() {return this.value;}).get().join(',');
		allproductDp=$('.dealer_price').map(function() {return this.value;}).get().join(',');
		allproductBv=$('.business_volume').map(function() {return this.value;}).get().join(',');
		allproductPrice=$('.price').map(function() {return this.value;}).get().join(',');
		
		$.ajax({
			type: "POST",
			dataType: "json",
			url:  'Product/getProductAmount',
			data:{allQty: allQty,allproductDp:allproductDp,allproductBv:allproductBv,allproductPrice:allproductPrice},	
			success: function(data)
			{

				if(data.error=='0')
				{
					$('#amount').val((data.amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
					$('#dealer_price').val((data.dealer_price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
					$('#business_volume').val((data.business_volume).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
				}					
				else
				{
					alert('Some error found.please wait');
					
					location.reload();
				}
			},
		});	
	}

</script>