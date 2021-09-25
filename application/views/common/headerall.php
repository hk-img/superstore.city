 <?php 
$root = root();
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
 	<title><?php if(isset($title)){ echo $title; }else{ ?>TMSS<?php } ?></title>
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
 	<link rel="shortcut i con" href="<?php echo base_url(); ?>web_root/images/logo-r.png">
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/bootstrap.css" />
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/style.css" />
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/animate.css" />
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/lightbox.css" />
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/font/font.css" />
 	<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/font/stylesheet.css" />
 	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 	<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/bootstrap.js"></script>
 	<script type="text/javascript" src="<?php echo $root;?>web_root/front_css/js/main.js"></script>
 	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
 	<link rel="stylesheet" href="<?php echo $root;?>web_root/front_css/font-awesome-4.6.1/css/font-awesome.min.css">
 </head>

 <body>
 	<div id="NewMsgBox" style="background:rgba(0, 0, 0, 0.55);height:100%;width:100%;
display:none;position: fixed;
    left: 0;
    right: 0;
    top: 0;
    z-index: 9999;">
 		<span class="ui_overlay ui_modal uploaderThanks"
 			style="position: fixed; right: auto; left: 391px; top: 206px;/*! display: none; */">
 			<div class="body_text" style="float: left;
margin-top: 30px;
margin-left: 225px;">
 				<div class="thanksOverlayInner">

 					<div class="thankyouInfo"></div>
 					<img src="<?php echo $root; ?>web_root/images/loader.gif" height="100px" width="100px" /></a>
 				</div><span style="color:white;font-size:20px;margin-left:-8px;margin-top:20px">Please Wait.....</span>
 			</div>
 			<div class="ui_close_x"></div>
 		</span>
 	</div>
    
 	<div class="navbar navbar-default main-header" role="navigation">
 		<div class="container">
 			<div class="navbar-header">
 				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
 					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
 						class="icon-bar"></span> <span class="icon-bar"></span> </button>
 				<a class="navbar-brand pad14" href="<?php echo $root; ?>home">
 					<img src="<?php echo $root;?>web_root/images/logo-r.png" alt="Logo" class="img-responsive" />
 					<!-- <span class="hidden-md logo clg">TMSS</span> -->
 				</a> 
			</div>
 			<div class="navbar-collapse collapse">
 				<ul class="nav navbar-nav navbar-right">
 					<li class="<?php if($this->session->userdata('tabmenu')=='home'){ echo "active"; }?>"><a
 							href="<?php echo base_url(); ?>home">Home </a></li>
							 <li class="<?php if($this->session->userdata('tabmenu')=='legalDocument'){ echo "active"; }?>"><a
 							href="<?php echo base_url(); ?>legal-document">Legal Document </a></li>
							 <li class="<?php if($this->session->userdata('tabmenu')=='contactus'){ echo "active"; }?>"><a
									 href="<?php echo base_url(); ?>contact-us">Contact Us </a></li>
 					<!--Start Login Menu-->
 					<?php if ($this->session->userdata('userlogin') !=''){  ?>
 					<li class=""><a href="<?php echo base_url('profile'); ?>">Dashboard</a></li>
 					<!--<li class="dropee"><a href="#" >Profit<span class="caret"></span></a>
		  <ul class="drpdwn">
				<li><a href="<?php echo base_url('current-profit') ?>">Current Profit</a></li>
				<li><a href="<?php echo base_url('previous-profit') ?>">Previous Profit</a></li>
				<li><a href="#">Previous Repurchase Profit</a></li>
				<li><a href="<?php echo base_url('reward'); ?>">Reward</a></li>                                   
			</ul>
		</li>-->
 					<!--
		<li class="dropee"><a href="#" >Epin<span class="caret"></span></a>
		  <ul class="drpdwn">
				<li><a href="<?php echo base_url('e-pin-all'); ?>">Epin</a></li> 
				<li><a href="#">Epin Create</a></li>
				<li><a href="#">Epin Transfer</a></li>
				<li><a href="#">Epin Transfer Statement</a></li>                           
			</ul>
		</li> 
		<li  class="dropee"><a href="#" >Wallet<span class="caret"></span></a>
		  <ul class="drpdwn">
				<li><a href="#">Fund Request</a></li> 
				<li><a href="#">Fund Request Detail</a></li>
				<li><a href="#">Fund Trasfer</a></li>
				<li><a href="#">Fund Trasfer To Member</a></li>                           
				<li><a href="#">E-wallet Statement</a></li>                           
				<li><a href="#">Cash wallet Statement</a></li>                           
			</ul>
		</li>
		<li class="<?php if($this->session->userdata('tabmenu')=='recharge'){ echo "active"; }?>"><a href="#">Recharge </a></li>-->
 					<?php } ?>

 					<!--End Login Menu-->

 					<?php if ($this->session->userdata('userlogin') ==''){ ?>
 					<li><a href="<?php echo base_url('login'); ?>" class="login left-btn lleft-btn"><span>Login</span></a> </li>
 					<li><a href="<?php echo base_url('registration'); ?>"
 							class="register rightt-btn"><span>Register</span></a> </li>
 					<?php }else{ ?>
 					<li style="margin-left:13px;"><a href="<?php echo base_url('logout'); ?>"
 							class="register right-btn"><span>Logout</span></a></li>
 					<?php } ?>
 				</ul>
 			</div>
 		</div>
 	</div>


 	<?php 
if($this->session->userdata('storesucmsg')){	
 ?>
 	<div class="alert alert-success" style="position: fixed;z-index: 99999;top: 32%;right: 11px;">
 		<?php 
	echo $this->session->userdata('storesucmsg');
	$this->session->unset_userdata('storesucmsg');
  ?>
 	</div>
 	<?php } ?>


 	<?php 
if($this->session->userdata('storefailmsg')){	
 ?>
 	<div class="alert alert-warning" style="position: fixed;z-index: 99999;top: 32%;right: 11px;">
 		<?php 
	echo $this->session->userdata('storefailmsg');
	$this->session->unset_userdata('storefailmsg');
  ?>
 	</div>
 	<?php } ?>