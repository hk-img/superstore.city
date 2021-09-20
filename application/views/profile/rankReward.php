 <style>
	 .achieve {test-align:center; -webkit-animation: NAME-YOUR-ANIMATION 1s infinite; /* Safari 4+ */ -moz-animation: NAME-YOUR-ANIMATION 1s infinite; /* Fx 5+ */ -o-animation: NAME-YOUR-ANIMATION 1s infinite; /* Opera 12+ */ animation: NAME-YOUR-ANIMATION 1s infinite; /* IE 10+, Fx 29+ */ }
	 @-webkit-keyframes NAME-YOUR-ANIMATION { 0%, 49% { background-color: #459c0980  }
	 50%, 100% { background-color: #e50000;  } }
 </style>
<?php 
	$totalBinaryPair=$this->db->select('SUM(net_pairs) as total')->where('user_id',$this->session->userdata('userlogin'))->get('str_userincome')->row()->total;
?>
<div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-xs-12">
			<div class="card mb-3">
				<div class="card-header"><i class="fa fa-money"></i> My Rank & Reward</div>
				<div class="card-body">
					<h4 class="text-center">Rank</h4>
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
						<div class="table-responsive">
						
							<table class="table table-bordered text-center" id="">
								<thead>
								    <tr >
                                        <th style="text-align:center">Sr. No.</th>
                                        <th style="text-align:center" >Rank Name</th>
                                        <th style="text-align:center" >B.V.</th>
                                        <th style="text-align:center">Status</th> 
                                    </tr>
								</thead>
								<tbody> 
									<tr>
										<td>1</td>
										<td>Rising Star</td>
										<td>20,000</td>
										<?php if($totalBinaryPair>=20000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>2</td>
										<td>Star</td>
										<td>50,000</td>
										<?php if($totalBinaryPair>=50000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>3</td>
										<td>Silver</td>
										<td>2,00,000</td>
										<?php if($totalBinaryPair>=200000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>4</td>
										<td>Gold</td>
										<td>5,00,000</td>
										<?php if($totalBinaryPair>=500000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>5</td>
										<td>Platinum</td>
										<td>10,00,000</td>
										<?php if($totalBinaryPair>=1000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>6</td>
										<td>Ruby</td>
										<td>20,00,000</td>
										<?php if($totalBinaryPair>=2000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>7</td>
										<td>Diamond</td>
										<td>50,00,000</td>
										<?php if($totalBinaryPair>=5000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>8</td>
										<td>Double Diamond</td>
										<td>2,00,00,000</td>
										<?php if($totalBinaryPair>=20000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>9</td>
										<td>Royal Diamond</td>
										<td>5,00,00,000</td>
										<?php if($totalBinaryPair>=50000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>10</td>
										<td>Blue Diamond</td>
										<td>10,00,00,000</td>
										<?php if($totalBinaryPair>=100000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>11</td>
										<td>Crow Diamond</td>
										<td>20,00,00,000</td>
										<?php if($totalBinaryPair>=200000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>									
							    </tbody> 
							</table>
						</div>
					</div>
				</div>
				<div class="card-body">
					<h4 class="text-center">Reward</h4>
					<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
						<div class="table-responsive">						
							<table class="table table-bordered text-center" id="">
								<thead>
								    <tr >
                                        <th style="text-align:center">Sr. No.</th>
                                        <th style="text-align:center" >Reward Name</th>
                                        <th style="text-align:center" >Value</th>
                                        <th style="text-align:center">Status</th> 
                                    </tr>
								</thead>
								<tbody> 
									<tr>
										<td>1</td>
										<td>Star</td>
										<td>2 Rising Star</td>
										<?php if($totalBinaryPair>=40000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>2</td>
										<td>Silver</td>
										<td>2 Star</td>
										<?php if($totalBinaryPair>=100000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>3</td>
										<td>Gold</td>
										<td>2 Silver</td>
										<?php if($totalBinaryPair>=400000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>4</td>
										<td>Platinum</td>
										<td>2 Gold</td>
										<?php if($totalBinaryPair>=1000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>5</td>
										<td>Ruby</td>
										<td>2 Platinum</td>
										<?php if($totalBinaryPair>=2000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>6</td>
										<td>Diamond</td>
										<td>2 Ruby</td>
										<?php if($totalBinaryPair>=10000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>7</td>
										<td>Double Diamond</td>
										<td>2 Diamond</td>
										<?php if($totalBinaryPair>=40000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>8</td>
										<td>Royal Diamond</td>
										<td>2 Double Diamond</td>
										<?php if($totalBinaryPair>=100000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>9</td>
										<td>Blue Diamond</td>
										<td>2 Royal Diamond</td>
										<?php if($totalBinaryPair>=200000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>	
									<tr>
										<td>10</td>
										<td>Crow Diamond</td>
										<td>2 Blue Diamond</td>
										<?php if($totalBinaryPair>=400000000){ echo '<td class="achieve">Achieve</td>'; }else{ echo '<td style="text-align:center">-</td>'; } ?>
									</tr>									
							    </tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('profile/dashboard_rightbar'); ?>
  </div>
</div>
</div>

 <script>
  
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script> 

