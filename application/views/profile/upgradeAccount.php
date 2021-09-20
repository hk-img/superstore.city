<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="card mb-3">
					<div class="card-header"><i class="fa fa-pencil-square-o"></i> Upgrade Account</div>
					<div class="card-body"> 	
						<?php 
							echo form_open_multipart(base_url('upgrade-account'));
						?> 
						<?php echo validation_errors(); ?>
						<table class="personal-detailsTable" width="100%">
							<tbody>
								<tr>
									<td valign="top" width="50%">
										<table width="100%" style="line-height:50px;">
											<tbody>
												<tr>
													<td style="width: 20%;">Member-ID</td>
													<td style="width: 40%;">
													<input type="text" placeholder="Member-ID"  onchange="getUserName()" id="unique_id" required name="unique_id" value="<?php echo set_value('unique_id'); ?>" class="form-control"   >
													</td>
													<td style="width: 40%"><span style="float:left;margin-left:15px" id="textUserName">Enter Member Id</span></td>
												</tr>
												<tr>
													<td>E-PIN</td>
													<td>
													<input type="text" placeholder="E-PIN"  required name="pin" value="<?php echo set_value('pin'); ?>" class="form-control"   >
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
													<button type="reset" class="btn btn-default" id="" name="upgrade" value="upgrade" style="margin-bottom:20px">Reset</button>
													<button type="submit" class="btn btn-success" id="" name="upgrade" value="upgrade" style="margin-bottom:20px;">Submit</button>
													</td>
													<td ></td>
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
 <style>
 	.siplayCls{
 		opacity: 1;
 	}
 	.siplayClsRe{
 		opacity: 0;
 	}
 </style>


<script type="text/javascript">

	getCity('<?php echo $value->state; ?>');  
	
	function getCity(state_id){ 
		selected='<?php echo $value->city; ?>';	
		$.ajax({
		type: "POST",
		url:  '<?php echo base_url('get-city'); ?>',
		data:{state_id: state_id,selected:selected },	
		success: function(data){ 
				$('#city_id').html(data);
			},
		}); 
	}
	
	getUserName();
	
	function getUserName()
	{ 
		userId=$('#unique_id').val();
		
		if(userId!='')
		{
			$.ajax({
				type: "POST",
				url:  'Home/getUserName',
				data:{userId: userId},	
				success: function(data)
				{ 
					if(data!='')
					{
						$('#textUserName').text(data);
					}						
				},
			}); 
		}		
	}
</script> 