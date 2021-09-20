<?php $root = getBaseUrlOfProject();
foreach($result as $key=>$value){}
?>
<section id="content" class="content-container">
	<section class="page-form-ele page">
	<section class="panel panel-default">
			<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Go To</strong></div>
			<div class="panel-body">
				<div class="space"></div>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo $root?>admin/Department/department"><i class="fa fa-list"></i> <?php echo $this->lang->line('viewdepartment');?></a>
				<a class="file-input-wrapper btn btn-default  btn-success" href="<?php echo $root?>admin/Department/adddepartment"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('adddepartment');?></a>
			</div>
		</section>

<div class="row">
         <div class="col-lg-12">
            <!-- Radio buttons and checkbox -->
            <section class="panel panel-default">
                <div class="panel-heading"><strong>
				<span class="glyphicon glyphicon-th"></span> <?php echo $this->lang->line('editdepartment');?></strong></div>
                <div class="panel-body">
					<div class="errorsinci">
					<?php echo validation_errors(); ?>
					</div>
					<?php echo form_open_multipart('admin/Department/editdepartmentend',array('class'=>'ng-pristine ng-valid')); ?>  
					<input type="hidden" name="id_val" required="required" value="<?php echo $value->id; ?>">
                    <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('enternamedepartment');?></label>
                            <input class="form-control" id="exampleInputEmail1" value="<?php echo $value->name; ?>" placeholder="<?php echo $this->lang->line('enternamedepartment');?>" type="text" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary btn-w-md"><?php echo $this->lang->line('submit');?></button>
                    </form>
                </div>
            </section>
            <!-- end Radio buttons and checkbox -->            
        </div>
    </div>
		</section>
</section>