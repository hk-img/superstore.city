<?php 
	
	
	$id='';$name='';$image_name='';
	if(!empty($result))
	{
		$id=$result->id;
		$name=$result->name;
		$image_name=$result->image_name;
	}
?>
<section id="content" class="content-container">

<section class="page-form-ele page">

  <section class="panel panel-default">

        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>

        <div class="panel-body">

			<div class="space"></div>

            <a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo base_url('admin/show-latest-news'); ?>"><i class="fa fa-eye"></i>  Show News</a>

        </div>

    </section>

<div class="row">

         <div class="col-lg-12">

            <!-- Radio buttons and checkbox -->

            <section class="panel panel-default">

                <div class="panel-heading"><strong>

				<span class="glyphicon glyphicon-th"></span> <?php echo $title; ?></strong></div>

                <div class="panel-body" >
					<span id="responsesMsg"></span>
					<div class="col-md-12">	
					<form action="<?php echo root(); ?>admin/News/addNewsEnd" method="POST" enctype="multipart/form-data">
					<?php echo form_open('#',array('class'=>'','name'=>'edit_user','id'=>'edit_user')); ?>
					<div class="form-group col-md-12 paddingZ">
							<div class="col-md-2 paddingZ">
								<label class="" for="exampleInputEmail1">Enter News.</label>
							</div>
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<div class="col-md-10">
							<input type="box"   placeholder="Enter News." class="form-control" name="name" required value="<?php echo $name; ?>"/>
						</div> 
                    </div>
					<div class="form-group col-md-12 paddingZ">
						<div class="col-md-2 paddingZ">
							<label class="" for="exampleInputEmail1">Image</label>
						</div>
						<input type="hidden" name="image" value="<?php echo $image_name; ?>" />
						<div class="col-md-4">
							<input type="file"  name="image_name"  value="<?php echo $name; ?>"/>
						</div> 
						<?php if($image_name!='')
						{
						?> 
						<div class="col-md-4">
							<img src="<?php echo base_url(); ?>web_root/admin_root/img/<?php echo $image_name; ?>" style="height:100px;width:100px" />
						</div> 
						<?php } ?>
					</div>
					<button type="submit" class="btn btn-primary btn-w-md">Submit</button>
				</form>
		</section>
		<!-- end Radio buttons and checkbox -->            
			</div>
	</div>		
    </div>
    </div> 
 </section>
 </section>
