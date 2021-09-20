 
<section id="content" class="content-container">
<section class="page-form-ele page">

  
	 <div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>
 

			  <div class="panel-body">
                    <div class="table-responsive">
                <table id="allUser" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No</th>
                            <th> User Name</th>
                            <th> Mobile No</th>
                            <th> Unique Id</th>
                            <th> Reference Id</th>
                            <th> Package Amount</th> 
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php  
							if(!empty($result))
							{
								$s_no=1;
								foreach($result as $resultKey=>$resultValue)
								{
						  ?>
                        <tr>
                            <td><?php echo $s_no;?></td>
							 <td><?php echo ucfirst($resultValue->name);?></td>
							 <td><?php echo ucfirst($resultValue->mobile);?></td>
							 <td><?php echo ($resultValue->unique_id);?></td>
                            <td><?php echo ($resultValue->referrer_id);?></td>  
							<td>
								<?php $packageAmount=getPackageAmtByUniqueId($resultValue->unique_id); if($packageAmount=='0'){ echo "Free Account"; }else { echo $packageAmount; }  ?>
							</td>
							 
                            <td>
							<?php 
							if($resultValue->kyc_upadte == 1)
							{
								?>
								<a  target="_blank" href="<?php echo base_url('admin/single-kyc'); ?>/<?php echo $resultValue->member_id; ?>"><span class='label label-info'><i class='fa fa-info'></i> View</span></a>
								<?php
							}
							elseif($resultValue->kyc_upadte ==0)
							{
								echo "Not Updated yet";
							} 
							elseif($resultValue->kyc_upadte=='2')
							{
								echo "KYC Approved";
							}
							elseif($resultValue->kyc_upadte == 3)
							{
								echo "KYC Rejectd";
							}
							?>
							</td>
                        </tr>
					<?php $s_no++; } ?>
					<?php  } ?>
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
		}
		);
	} );
</script>
