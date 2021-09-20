<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>web_root/images/ayr-final.png">
  <title><?php if(isset($title)){ echo $title; }else{ echo 'AYR Group'; } ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo $root;?>web_root/front_css/font-awesome-4.6.1/css/font-awesome.min.css">
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo $root;?>web_root/front_css/css/sb-admin.css"/>
<script src="https://code.jquery.com/jquery-1.12.4.js" ></script> 
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body style="margin-bottom: 56px;padding-top: 56px;">
 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>web_root/images/ayr-final.png" class="img-responsive" style="height: 40px;"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('profile'); ?>">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#account" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user-secret"></i>
            <span class="nav-link-text">Account</span>
          </a>
          <ul class="sidenav-second-level collapse" id="account">
            <li>
              <a href="<?php echo base_url('user-profile'); ?>">Profile</a>
            </li>
            <li>
              <a href="<?php echo base_url('edit-profile'); ?>">Edit Profile</a>
            </li>
            <li>
              <a href="<?php echo base_url('change-password'); ?>">Change Password</a>
            </li>
            <li>
              <a href="<?php echo base_url('upgrade-account'); ?>">Upgrade Account</a>
            </li>
             <li>
              <a href="<?php echo base_url('current-profit'); ?>">Current Profit</a>
            </li>
            <li>
              <a href="<?php echo base_url('rewards'); ?>">Reward</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#group" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Group</span>
          </a>
          <ul class="sidenav-second-level collapse" id="group">
            <li>
              <a href="<?php echo base_url('genealogy'); ?>">Genealogy</a>
            </li>
          </ul>
        </li> 
        <li class="nav-item">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#epin" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user-secret"></i>
            <span class="nav-link-text">E-PIN WALLET</span>
          </a>
          <ul class="sidenav-second-level collapse" id="epin">
            <li>
              <a href="<?php echo base_url('e-pin-all'); ?>">Received Pin</a>
            </li>
            <li>
              <a href="<?php echo base_url('e-pin-used'); ?>">Used Pin</a>
            </li>
            <li>
              <a href="<?php echo base_url('e-pin-unused'); ?>">Unused Pin</a>
            </li> 
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('update-kyc'); ?>">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Update KYC</span>
          </a>
		  
        </li>
		<?php 
			$userResult=$this->db->select('member_id')->get_where('str_member',array('member_id'=>$this->session->userdata('userlogin'),'pv_value >'=>'0'))->row_array();
			if(!empty($userResult))
			{
		?>
			<li class="nav-item">
			  <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#product" data-parent="#exampleAccordion">
				<i class="fa fa-shopping-cart"></i>
				<span class="nav-link-text">Product</span>
			  </a>		  
			  <ul class="sidenav-second-level collapse" id="product">
				<?php 			
					$productResult=$this->db->where('user_id',$this->session->userdata('userlogin'))->get('repurchase_product')->row_array();
					if(!empty($productResult))
					{
				?>
					<li><a href="<?php echo base_url('repurchase-product'); ?>">Repurchase Product</a></li>
				<?php }else{ ?>
					<li><a href="<?php echo base_url('repurchase-product'); ?>">First Purchase</a></li>
				<?php } ?>
				<li><a href="<?php echo base_url('repurchase-product-list'); ?>">Purchase List</a></li> 
			  </ul>
			</li> 
		<?php } ?>
		
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('passbook'); ?>">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Passbook</span>
          </a>
        </li>
		<li class="nav-item">
            <span class="nav-link">
			<?php 
				$userResult=$this->db->select('image,name')->where('member_id',$this->session->userdata('userlogin'))->get('str_member')->row_array();
				if($userResult['image']!='' && file_exists('./web_root/images/userimage/'.$userResult['image']))
				{
					?>
						<img src="<?php echo base_url(); ?>web_root/images/userimage/<?php echo $userResult['image']; ?>" class="img-responsive" alt="user image" style="height:80px">
					<?php 
				}
				else
				{
					echo '<img src="'.base_url().'web_root/images/rank-holder-image.png" class="img-responsive" alt="rank holder">';
				}
			?>
            
            <p class="nav-link-text" style="margin: 10px 0 5px;"><?php echo ucfirst($userResult['name']); ?></p>
            <p class="nav-link-text"><?php echo $this->Form_model->getRankName($this->session->userdata('userlogin')); ?></p>
            </span>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link">
            <i class="fa fa-fw fa-user"></i>Username: <?php echo getNameByMemberId($this->session->userdata('userlogin')); ?></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  
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
