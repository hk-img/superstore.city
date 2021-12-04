  <style>
	.pin-widget {
		background: green;
		padding: 15px 10px;
		position: relative;
		margin-bottom: 20px;
		border-radius: 4px;
		width: 100%;
		float: left;
	}
	.pin-widget .widget-item-left {
		float: left;
		margin-right: 5px;
		font-size: 40px;
		width: 48px;
		height: 48px;
	}
	.pin-widget .widget-item-left i {
		position: relative;
		top: -8px;
	}
	.widget-data{
		width: calc(100% - 53px);
		float: left;
	}
	.widget-subtitle{
		width: 100%;
		float: left;    
		padding: 5px 8px;
		border-radius: 4px;
		font-size: 12px;
	}
  </style>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-align-center"></i> E-Pin Statement<small> - <?php echo count($result); ?> Record Found</small></div>
				<div class="card-body">   
				
					<?php 
					if(!empty($result))
					{
					foreach($result as $key=>$value)
					{ 
					?>
					<div class="col-sm-4 col-xs-12 mb-3"> 
						<div class="pin-widget">
							<div class="widget-item-left">
								<i class="fa fa-credit-card"></i>
							</div>
							<div class="widget-data">
								<div class="widget-int num-count">
									<?php 
										echo checkPinAmount($value->pin_no); 
									?><small>INR</small>
								</div>
								<div class="widget-title"><p onclick="copy(this)"><?php echo $value->pin_no ?></p>
								</div>
							</div>
							<div class="widget-subtitle" style="background:#52a452">
								<?php 
									echo  date("M d Y H:i:a", strtotime($value->created_date))
								?>
								<br>( Used   <?php if($value->used_status=='1') { echo getUniqueIdById($value->used_byid); } else { echo "N/A"; } ?> )
							</div> 
						</div> 
					</div> 
					<?php
						}
					}
					else
					{
						echo "No Pin Found.";
					}
					?>  
				</div>
			</div>
		</div>
 
	</div>
</div>
<script>
function copy(that){
var inp =document.createElement('input');
document.body.appendChild(inp)
inp.value =that.textContent
inp.select();
document.execCommand('copy',false);
inp.remove();
alert('E-pin copied');
}
</script>
</div>