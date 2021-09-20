 
<section id="content" class="content-container">
<section class="page-form-ele page">

	<section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/user-statement'); ?>"><i class="fa fa-bank"></i>  User Statement</a>

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
                            <th> Rewards For</th>
                            <th> Main Amount</th>
                            <th> Receive Amount</th>
                            <th> Admin Charge</th>
                            <th> Tds Charge</th>
                            <th> Final Amount</th>
                            <th> Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
					   <?php 	
						$s_no=1;$finalAmount=0;
						foreach($result as $key=>$value)
						{ 		
						
					   ?>
							<tr>
							  <td><?php echo $s_no; ?></td>
							  <td><?php echo $this->Form_model->getParticularName($value->particular_id); ?></td>
								<td><?php echo $value->amount; ?></td>
								<td><?php if($value->type=='dr'){ echo $value->net_amount; }else { echo "0.00"; }?></td>
								<td><?php if($value->type=='dr'){ echo $value->admin_amount; }else { echo "0.00"; }?></td>
								<td><?php if($value->type=='dr'){ echo $value->tds_amount; }else { echo "0.00"; }?></td>
								<td><?php if($value->type=='dr'){ $finalAmount-=($value->amount); }else {  $finalAmount+=($value->amount); } echo number_format($finalAmount,2); ?></td>
								<td ><?php echo $value->created_date; ?></td>
							</tr>
					   <?php 
					   $s_no++;
					   } 
					   ?>                 
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
			"order": [[ 0, "desc" ]]
		}
		);
	} );
</script>
