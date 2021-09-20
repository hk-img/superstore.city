 <?php
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 
?>
<div class="container-fluid">
	<div class="container" style="min-height:350px;">
	<style>
	li{
		line-height:25px;
		
	}
	.a{
		margin-top:10px;
	}
	</style>
		<ul class="form-control" style="margin-top:95px;padding:50px;">
		<span style="color:red;font-size:17px;">This error has occured for one of the following reasons :</span>
<li class="a">You have used Back/Forward/Refresh button of your Browser.</li>
<li>You have clicked twice on any options/buttons.</li>
<li>You have kept the browser window idle for a long time.</li>
<li>You have logged in from another browser window</li>
<li>You are accessing the application URL from a saved or static page. </li>
<a href="<?php echo $root; ?>">Please try For booking.</a>
		</ul>		
	</div>
</div>