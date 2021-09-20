 
<section id="content" class="content-container">
<section class="page-form-ele page">

   <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/add-achiver'); ?>"><i class="fa fa-plus"></i>  Add Achiever</a>

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
                            <td><?php echo ucfirst($resultValue->name);?></td>
                          <td>
							<a  target="_blank" href="<?php echo base_url('admin/add-achiver'); ?>/<?php echo $resultValue->id; ?>"><span class='label label-info'><i class='fa fa-pencil'></i> Edit</span></a>
							<a  onclick="return confirm('Are You Sure ? You want to confirm delete.')"  href="<?php echo base_url('admin/Achiver/deleteAchiver'); ?>/<?php echo $resultValue->id; ?>"><span class='label label-danger'><i class='fa fa-trash-o'></i> Delete</span></a>
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
