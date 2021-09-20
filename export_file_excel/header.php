<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="dfsd">
  <meta name="keywords" content="here">
  <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/int.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   
<link href="font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body style="background:#FFFFFF;">
<div class="container-fluid paddzero firstsec" style="padding:0px;">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding:0px;">
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-12" style="padding:0px;background:rgb(6, 94, 132) none repeat scroll 0% 0%;min-height:4000px;">
<div style="position:fixed;left:0px;">
<?php 
 $root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>
<a href="<?php echo $root."../admins/home"?>">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding:0px;margin-top:20px;">
<i class="fa fa-paw ic left"></i>
<h4 class="whe left head">Tractor Junction</h4>
</div>
</a>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 26px 0px 27px;">

<div id='cssmenu'>
<ul>
   <li class='active'></li>
   
   <li class='has-sub'><a href='#'><span>Home</span></a>
      <ul>
         <li><a href="<?php echo $root."../admins/home"?>"><span>Home</span></a></li>
      </ul>
   </li>
   
</ul>
</div>





</div>
</div>
</div>
<!-- second/slide section -->
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-12" style="padding:0px;min-height:900px;background: #fff;">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 slidehead" style="padding:px;">

<a href="<?php echo $root."../index.php/admins/Logout"?>"><button type="button" class="btn btn-default logbuttn" style="">Log Out</button></a>
</div>
