
<?php 
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
 <a href="<?php echo $root; ?>language/index/english" class="aClsCSS">English</a>
 <a href="<?php echo $root; ?>language/index/chinese" class="aClsCSS">Chinese</a>
 <?php
	echo $this->lang->line('message');
	echo $this->lang->line('messagenew');die;
 ?>