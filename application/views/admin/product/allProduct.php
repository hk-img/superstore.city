 
<section id="content" class="content-container">
<section class="page-form-ele page">

   <section class="panel panel-default">
		<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>
		<div class="panel-body">
			<div class="space"></div>
			<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/add-product'); ?>"><i class="fa fa-plus"></i>  Add Product</a>
			<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-repurchase-product'); ?>"><i class="fa fa-eye"></i>  Repurchase Product</a>
			<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/repurchase-bonus'); ?>"><i class="fa fa-eye"></i>  Repurchase Bonus</a>
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
                            <th> Product Image</th>
                            <th> Product Name</th>
                            <th> Product Price</th>
                            <th> Service Tax</th>
                            <th> B.V.</th>
                            <th> DP</th>
                            <th> Status</th>
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
                            <td><img src="<?php echo base_url(); ?>web_root/images/product_image/<?php echo $resultValue->image_name; ?>" style="height:100px;width:100px" /></td>
                            <td><?php echo ucfirst($resultValue->name);?></td>
                            <td><?php echo $resultValue->price; ?></td>
                             <td><?php echo $resultValue->service_tax; ?></td>
                              <td><?php echo $resultValue->business_volume; ?></td>
                              <td><?php echo $resultValue->dealer_price; ?></td>
                             <td>
                                <?php if($resultValue->status=='1')
                                {
                                    echo "<span class='label label-success'>Active</span>";
                                }
                                else
                                {
                                    echo "<span class='label label-danger'>DeActive</span>";
                                }
                                ?>
                            </td>
                             </td>
                          <td>
							<a  target="_blank" href="<?php echo base_url('admin/add-product'); ?>/<?php echo $resultValue->id; ?>"><span class='label label-info'><i class='fa fa-pencil'></i> Edit</span></a>
							<a  onclick="return confirm('Are You Sure ? You want to confirm delete.')"  href="<?php echo base_url('admin/Product/deleteProduct'); ?>/<?php echo $resultValue->id; ?>"><span class='label label-danger'><i class='fa fa-trash-o'></i> Delete</span></a>
						   <?php if($resultValue->status=='0')
						   {
						       ?>
						  <a  onclick="return confirm('Are You Sure ? You want to change product status.')"  href="<?php echo base_url('admin/Product/changeStatus'); ?>/<?php echo $resultValue->id; ?>/1"><span class='label label-success'><i class='fa fa-check'></i> Change status</span></a>
					    <?php }else{ ?>
					       <a  onclick="return confirm('Are You Sure ? You want to change product status.')"  href="<?php echo base_url('admin/Product/changeStatus'); ?>/<?php echo $resultValue->id; ?>/0"><span class='label label-success'><i class='fa fa-check'></i> Change status</span></a> 
					  <?php  }
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
