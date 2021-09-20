 
<section id="content" class="content-container">
<section class="page-form-ele page">
	
	<section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>
			<?php 
				if($clubId!='7')
				{
				?>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/silverclub-users'); ?>"><i class="fa fa-users"></i>  Silver Club Users</a>
				<?php } 
				if($clubId!='8')
				{
				?>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/starclub-users'); ?>"><i class="fa fa-users"></i> Star Club Users</a>
				<?php } 
				if($clubId!='9')
				{
				?>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/emerldclub-users'); ?>"><i class="fa fa-users"></i> Emerld Club Users</a>
				<?php } ?>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/emerldclub-users'); ?>"><i class="fa fa-users"></i> Reward User List</a>
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
                            <th> Name</th>
                            <th> Unique Id</th>
                            <th> Package Amount</th>
                            <th> Total Reward Amount</th>
							<th>Action </th>
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
                            <td><?php echo ($resultValue->unique_id);?></td>
                             <td><?php $packageAmount=getPackageAmtByUniqueId($resultValue->unique_id); if($packageAmount=='0'){ echo "Free Account"; }else { echo $packageAmount; }  ?></td>
							<td><?php $amountResult=$this->db->select('SUM(amount) as amount')->where('particular_id',$clubId)->where('user_id',$resultValue->member_id)->get('str_wallet')->row();  if($amountResult->amount>0) { echo $amountResult->amount; }else { echo '0.00'; }?></td>
							<td>
								<a title="Balance sheet" target="_blank" href="<?php echo base_url(); ?>admin/user-balancesheet/<?php echo $resultValue->member_id; ?>"><span class="label label-info"><i class="fa fa-exchange"></i> </span></a>
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
