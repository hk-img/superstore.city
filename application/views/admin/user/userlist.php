 
<section id="content" class="content-container">
<section class="page-form-ele page">

  
	 <div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> View Users</strong></div>
 

			  <div class="panel-body">
                    <div class="table-responsive">
                <table id="allUser" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No</th>
                            <th> Reg Date</th>
                            <th> Name</th>
                            <th> Mobile</th>
                            <th> Unique Id</th>
                            <th> Reference Id</th>
                            <th> Package Amount</th>
                            <th> Activation Date</th>
                            <th> Password</th>
                            <th> Action</th>
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
                            <td><?php echo $resultValue->created_date; ?></td>
                            <td><?php echo ucfirst($resultValue->name);?></td>
                            <td><?php echo ($resultValue->mobile);?></td>
                            <td><?php echo ($resultValue->unique_id);?></td>
                            <td><?php echo ($resultValue->referrer_id);?></td>
                            <td><?php $packageAmount=getPackageAmtByUniqueId($resultValue->unique_id); if($packageAmount=='0'){ echo "Free Account"; }else { echo $packageAmount; }  ?></td> 
							<td><?php if($resultValue->active_date!='0000-00-00 00:00:00'){ echo date("d-M-Y H:i:s", strtotime($resultValue->active_date)); } ?></td>
							
                            <td><?php echo ($resultValue->password);?></td>
                            <td><a  target="_blank" href="<?php echo base_url('admin/edit-user'); ?>/<?php echo $resultValue->member_id; ?>"><span class='label label-info'><i class='fa fa-pencil'></i> Edit</span></a></td>
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
		$('#allUser').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'csv', 'excel'
			]
		} );
	} );
</script>
