 
<section id="content" class="content-container">
<section class="page-form-ele page">

	<section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            	<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/silverclub-users'); ?>"><i class="fa fa-users"></i>  Silver Club Users</a>
            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/starclub-users'); ?>"><i class="fa fa-users"></i> Star Club Users</a>
            	<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/reward-user-list'); ?>"><i class="fa fa-users"></i> Emerld Club Users</a>
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
                            <th> Reward Date and Time</th>
                            <th> User Id</th>
                            <th> User Name</th>
                            <th> Reward Name</th>
                            <th> Reward Amount</th> 
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
                            <td><?php echo getUniqueIdById($resultValue->user_id); ?></td>
                            <td><?php echo getNameByMemberId($resultValue->user_id);?></td>  
						    <td><?php echo ucfirst($resultValue->reward_type); ?></td> 
						    <td> <?php echo $resultValue->amount; ?> </td>
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
