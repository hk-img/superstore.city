<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$root = root();
	if($this->session->userdata('store100mlmadmin')==''){
		header("location:".root()."admin/logout");
		die;
	}
?>
<title><?php if(isset($title)) { echo $title; }else { echo 'Ayr Group Admin'; } ?></title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo $root; ?>web_root/admin_root/css/main.css"/>   
<link rel="stylesheet" href="<?php echo $root; ?>web_root/admin_root/font-awesome/css/font-awesome.css"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>web_root/admin_root/css/bootstrap-select.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>	 
<div id="payroll_loader" style="background:rgba(0, 0, 0, 0.55);height:100%;width:100%;display:none;position: fixed;left: 0;right: 0;top: 0;z-index: 9999;">
		<span class="ui_overlay ui_modal uploaderThanks" style="position: fixed; right: auto; left: 391px; top: 206px;/*! display: none; */">
			<div class="body_text" style="float: left;margin-top: 30px;margin-left: 225px;">
				<div class="thanksOverlayInner">
					<div class="thankyouInfo"></div>
					<img src="<?php echo $root; ?>web_root/admin_root/img/loader.gif" height="100px" width="100px"/></a>
				</div>
				<span style="color:white;font-size:20px;margin-left:-8px;margin-top:20px">Please Wait.....</span>
			</div>
			<div class="ui_close_x"></div>
		</span>		
	</div>
<script>$("#payroll_loader").css("display", "block"); </script>
 <!-- google fonts -->	
<script type="text/javascript">
	WebFontConfig = {
		google: { families: [ 'Lato:300,400,700,300italic,400italic:latin' ] }
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = 'bower_components/webfontloader/webfontloader.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})(); 
</script>
<style>	
	a {
		color:#125178;
	}
</style>	
</head>
<span id="error" style="position: relative; z-index: 1;"></span>  
<?php  if($this->session->userdata('digitalcashadminmessageTrue')){ ?>
	<div class="alert alert-success SucceSSCLS" id="message-box"><i class="fa fa-times" onclick="deleteMsg()" style="float: right;padding-right: 0px;margin-top: -12px;    margin-right: -10px;"></i>
		<strong><i class="fa fa-check-circle"></i> Success!</strong>
			<?php 
				echo $this->session->userdata('digitalcashadminmessageTrue');
				$this->session->unset_userdata('digitalcashadminmessageTrue');
			?>
	</div> 
<?php  } if($this->session->userdata('digitalcashadminmessageFalse')){ ?>
	<div class="alert alert-danger SucceSSCLS" id="message-box"><i class="fa fa-times" onclick="deleteMsg()" style="float: right;padding-right: 0px;margin-top: -12px;    margin-right: -10px;"></i>
	<strong>ERROR!</strong> <?php 
		echo $this->session->userdata('digitalcashadminmessageFalse');
		$this->session->unset_userdata('digitalcashadminmessageFalse');
	?>
	</div>
<?php 
}
	
?>
<body data-ng-app="app" id="body" data-custom-page  data-off-canvas-nav data-ng-controller="AppCtrl">
 <section id="app-container">
            <section id="app" class="app">
<header id="header" style="background:linear-gradient(120deg,#1486a0 25%,#6e4593 85%);" class="header-container"
                         data-ng-class="{ 'header-fixed': main.fixedHeader,
                                          'bg-light': ['11','12','13','14','15','16','21'].indexOf(main.skin) >= 0,
                                          'bg-dark': main.skin === '31',
                                          'bg-primary': ['22','32'].indexOf(main.skin) >= 0,
                                          'bg-success': ['23','33'].indexOf(main.skin) >= 0,
                                          'bg-info-alt': ['24','34'].indexOf(main.skin) >= 0,
                                          'bg-warning': ['25','35'].indexOf(main.skin) >= 0,
                                          'bg-danger': ['26','36'].indexOf(main.skin) >= 0
                         }">
                <header class="top-header clearfix">

    <!-- Logo -->
      <div class="logo" >
         <span class="logo-icon glyphicon glyphicon-th-large" toggle-off-canvas style="cursor:pointer;"></span>
			<span class="logo-text">AYR Group</span>
        </a>
    </div>
    <!-- needs to be put after logo to make it work -->
    <div class="menu-button" toggle-off-canvas>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </div>
    <div class="top-nav">
        <ul class="nav-right pull-right list-unstyled">
             <li class="dropdown text-normal nav-profile" uib-dropdown is-open="status.isopenProfile" style="padding-top:5px;">
                <a href="javascript:;" class="active-flag" uib-dropdown-toggle ng-disabled="disabled">
                    <i class="fa fa-user"></i> 
					<span id="admin_name"><?php foreach(SelectQuery('user_name','admin','id','1') as $raa) echo $raa->user_name; ?></span>				
                </a>
                <ul class="dropdown-menu with-arrow pull-right dropdown-menu-scaleIn" uib-dropdown-menu>
                    <li>
                        <a href="<?php echo $root; ?>admin/change_username">
                            <i class="fa fa-user"></i>
                            <span data-translate=""> Change Username</span>
                        </a>
                    </li> 
					<li>
                        <a href="<?php echo $root; ?>admin/change-password">
                            <i class="fa fa-key"></i>
                            <span data-translate=""> Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $root; ?>admin/logout">
                            <i class="fa fa-sign-out"></i>
                            <span data-translate=""> Logout</span> 
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
</header>  
 <?php $this->load->view('admin/sidebar'); ?>
 
	<div id="payroll_loader" style="background:rgba(0, 0, 0, 0.55);height:100%;width:100%;display:none;position: fixed;left: 0;right: 0;top: 0;z-index: 9999;">
		<span class="ui_overlay ui_modal uploaderThanks" style="position: fixed; right: auto; left: 391px; top: 206px;/*! display: none; */">
			<div class="body_text" style="float: left;margin-top: 30px;margin-left: 225px;">
				<div class="thanksOverlayInner">
					<div class="thankyouInfo"></div>
					<img src="<?php echo $root; ?>web_root/admin_root/img/loader.gif" height="100px" width="100px"/></a>
				</div>
				<span style="color:white;font-size:20px;margin-left:-8px;margin-top:20px">Please Wait.....</span>
			</div>
			<div class="ui_close_x"></div>
		</span>		
	</div>
