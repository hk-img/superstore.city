 
<section id="content" class="content-container">
<section class="page-form-ele page">

	<section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <!--<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('Excel/showAllTdsstatement'); ?>"><i class="fa fa-bank"></i>  TDS Report</a>-->
            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('Excel/showstatement'); ?>"><i class="fa fa-file-excel-o"></i> Export statement</a>
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
                <table id="allUser" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No</th>
                            <th> User Id</th>
                            <th> User Name</th>
                            <th> Total Amount</th>
                            <th> Due Amount</th>
                            <th> Complete Amount</th>
                            <th> Bank Detail</th>
                            <th style="width:87px"> Action</th>
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
								<div id="<?php echo $resultValue->member_id; ?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">
								<!-- Modal content-->
								<?php 
								$att=array('class'=>'form-horizontal form-label-left');
								echo form_open_multipart('admin/User/sendmoney',$att);

								?>
									<div class="modal-content">
									  <div class="modal-header">
									  <input type="hidden" name="userid" value="<?php echo $resultValue->member_id; ?>" />
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Insert amount</h4>
									  </div>
									  <div class="modal-body">
										<input type="number" class="form-control" name="amount" required/>
									  </div> 
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-default"  >Transfer</button>
									  </div>
									</div>
								<?php echo form_close(); ?>
								  </div>
								</div>
                        <tr>
                            <td><?php echo $s_no;?></td>
                            <td><?php echo $resultValue->unique_id; ?></td>
                            <td><?php echo ucfirst($resultValue->name);?></td> 
							<td><?php $crBalance=$this->Form_model->totalGrossBalance($resultValue->member_id); echo number_format($crBalance,2); ?></td> 
							<td>
								<?php 
									$confirmBalance=$this->Form_model->confirmGrossBalance($resultValue->member_id); 
									$pendingBalance=$this->Form_model->confirmPendingBalance($resultValue->member_id); 
									echo number_format((($crBalance)-$confirmBalance),2); 
								?>
							</td> 
							<td><?php echo number_format($confirmBalance,2); ?></td> 
							<td>
								<?php 
									echo $resultValue->account_no."<br>".$resultValue->ifsc_code;
								?>
							</td> 
                             <td><!--
								<a   href="#" title="Fund Transfer" data-toggle="modal" data-target="#<?php echo $resultValue->member_id; ?>" ><span class='label label-success'><i class='fa fa-inr'></i> </span></a> &nbsp;-->
								<a  title="Balance sheet" target="_blank" href="<?php echo base_url('admin/user-balancesheet'); ?>/<?php echo $resultValue->member_id; ?>"><span class='label label-info'><i class='fa fa-exchange'></i> Check Statement</span></a> &nbsp;
						        <!--a  title="TDS Export"  href="<?php echo base_url('Excel/showTdsstatement'); ?>/<?php echo $resultValue->member_id; ?>"><span class='label label-success'><i class='fa fa-bank'></i> </span></a>-->
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
