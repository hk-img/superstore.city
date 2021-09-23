 
 
 <div class="main-container">
	<aside id="nav-container" class="nav-container nav-vertical" style='background:linear-gradient();'   data-ng-class="{'nav-fixed': main.fixedSidebar,'bg-light': ['31','32','33','34','35','36'].indexOf(main.skin) >= 0,'bg-dark': ['31','32','33','34','35','36'].indexOf(main.skin) < 0}">
	   <div class="nav-wrapper">
		<ul  id="nav" class="nav" data-slim-scroll data-accordion-nav data-highlight-active>
        <li><a href="<?php echo base_url('admin/Home'); ?>"><i class="fa fa-dashboard"><span class="icon-bg bg-danger"></span></i>
			<span class="mainspanclass" data-translate="">Dashboard</span> </a>
		</li> 
		<li><a href="<?php echo base_url('admin/Home'); ?>"><i class="fa fa-users "><span class="icon-bg bg-success"></span></i>
			<span class="mainspanclass" data-translate="">Users</span> </a>
			<ul>
				  <li><a href="<?php echo base_url('admin/show-users'); ?>"><i class="fa fa-circle"></i><span data-translate="">Users</span></a></li>
		 </ul> 	
		</li>
		<!--
		<li><a href="#"><i class="fa fa-users "><span class="icon-bg bg-danger"></span></i>
			<span class="mainspanclass" data-translate="">Club Users</span> </a>
			<ul>
				  <li><a href="<?php echo base_url('admin/silverclub-users'); ?>"><i class="fa fa-circle"></i><span data-translate="">Silver Club Users</span></a></li>
				  <li><a href="<?php echo base_url('admin/starclub-users'); ?>"><i class="fa fa-circle"></i><span data-translate="">Star Club Users</span></a></li>
				  <li><a href="<?php echo base_url('admin/emerldclub-users'); ?>"><i class="fa fa-circle"></i><span data-translate="">Emerld Club Users</span></a></li>
				  <li><a href="<?php echo base_url('admin/reward-user-list'); ?>"><i class="fa fa-circle"></i><span data-translate="">Reward User List</span></a></li>
		 </ul> 	
		</li>
		-->
		<li>
		   <a href="/#"><i class="fa fa-key"><span class="icon-bg bg-orange"></span></i>  
					<span class="icon-bg bg-danger"></span> </i>
				<span class="mainspanclass" data-translate="">PIN</span>
			</a>
			<ul>
				<li><a href="<?php echo base_url('admin/create-pin'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Create PIN</span></a></li>
				<li><a href="<?php echo base_url('admin/all-pin'); ?>"><i class="fa fa-circle"></i><span data-translate=""> All PIN</span></a></li> 
			</ul>
	   </li> 
	   <li>
		   <a href="<?php echo base_url('admin/show-kyc'); ?>"><i class="fa fa-newspaper-o"><span class="icon-bg bg-danger"></span></i>  
					<span class="icon-bg bg-danger"></span> </i>
				<span class="mainspanclass" data-translate="">Show Kyc</span>
			</a> 
	   </li> 
	   <!--
	   <li>
		   <a href="/#"><i class="fa fa-product-hunt"><span class="icon-bg bg-orange"></span></i>  
					<span class="icon-bg bg-danger"></span> </i>
				<span class="mainspanclass" data-translate="">Product</span>
			</a>
			<ul>
				<li><a href="<?php echo base_url('admin/add-product'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Add Product</span></a></li>
				<li><a href="<?php echo base_url('admin/show-product'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Show Product</span></a></li> 
				<li><a href="<?php echo base_url('admin/show-repurchase-product'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Repurchase Product</span></a></li> 
		        <li><a href="<?php echo base_url('admin/repurchase-bonus'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Repurchase Bonus</span></a></li> 
			</ul>
	   </li>  -->
	   <li>
		   <a href="/#"><i class="fa fa-newspaper-o"><span class="icon-bg bg-success"></span></i>  
					<span class="icon-bg bg-danger"></span> </i>
				<span class="mainspanclass" data-translate="">Latest News</span>
			</a>
			<ul>
				<li><a href="<?php echo base_url('admin/add-latest-news'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Add News</span></a></li>
				<li><a href="<?php echo base_url('admin/show-latest-news'); ?>"><i class="fa fa-circle"></i><span data-translate=""> Show News</span></a></li> 
			</ul>
	   </li>
	   <li><a href="<?php echo base_url('admin/withdrawl-request'); ?>"><i class="fa fa-inr"><span  class="icon-bg bg-green"></span></i>
		    <span class="mainspanclass" data-translate="" style="margin-left:-4px"  >Withdrawl Request</span> </a>
		</li>
	   <li><a href="<?php echo base_url('admin/user-statement'); ?>"><i class="fa fa-exchange"><span class="icon-bg bg-orange"></span></i>
			<span class="mainspanclass" data-translate="">User Statement</span> </a>
		 </li>	
		 <!--
		<li><a href="<?php echo base_url('admin/show-turnover'); ?>"><i class="fa fa-product-hunt"><span class="icon-bg bg-green"></span></i>
			<span class="mainspanclass" data-translate="">Show Turnover</span> </a>
		</li>	
		<li><a href="<?php echo base_url('admin/show-bonanza'); ?>"><i class="fa fa-gift"><span class="icon-bg bg-green"></span></i>
			<span class="mainspanclass" data-translate="">Bonanza Offer</span> </a>
		</li>	--> 
    </ul>
 </div>
</aside>

