 <?php 
		if(isset($_GET['search']))
		{
			$search=$_GET['search'];
		}
		else
		{
			$search=getUniqueIdById($this->session->userdata('userlogin'));
		} 
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header"><i class="fa fa-tree"></i> Genealogy Tree</div>
        <div class="card-body" style="background: #eee"> 
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;"> 
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal">
						 <form action="<?php echo base_url('genealogy'); ?>" >
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="fa fa-search"></span></div>
									<input name="search" id="PlaceHolder_txtPromoterid" placeholder="member id" class="form-control" type="text" value="<?php echo $search; ?>" required >
								 </div>
							 </div>
							  <div class="col-md-4 paddingZ">								
								<div class="input-group-btn">
									<input  value="Search"  id="PlaceHolder_btnshow" class="btn btn-primary" type="submit" style="width: 100%;border-radius: 4px;">
								</div>
							  </div>
						  </form>
					</div>
                </div>
            </div>
        </div>
    </div>
  <div class="row">
    <section class="col-md-12 col-sm-12 col-xs-12" style="margin-top:80px; margin-bottom:30px"> 
        <div class="col-md-12 col-sm-12 col-xs-12">   
				<table width="95%" class="genealogy" style="margin: auto;" cellspacing="0" cellpadding="0" border="0" align="center">
					<tbody>
						<tr>
							<td colspan="8" valign="top" align="center"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<span style="color: #ff0066">&nbsp;</span>
							</td>
							<td class="tableTd" colspan="4" align="center">
									<?php 
										$result=$this->Form_model->showTreeMemberInfo($search);
										
										$image='Green.png';
										
										if($result['package_amount']=='Free Account')
										{
											$image='Red.png';
										}
										
									?>
								
									<img id="PlaceHolder_Img0" src="<?php echo base_url('web_root/images/group/'.$image); ?>" />
									<table id="PlaceHolder_Img0infoT" class="infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
									<br>
									<strong class="style5"><a id="PlaceHolder_Link0"  href="#"><?php echo $search; ?></a></strong>
							</td>
							<td colspan="2" align="center">
								<span style="color: #ff0066">&nbsp;</span>
							</td>
						</tr>
						<tr>
							<td colspan="8" width="100%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line.gif" border="0">
							</td>
						</tr>
						<?php 
							/*===First level of binary tree====*/
						
							$data = tree_data($search);
							$first_left_user='';
							$first_right_user='';
							
							if(!empty($data))
							{
								$first_left_user = $data['0']->left;
							}
							
							if(!empty($data) )
							{
								$first_right_user = $data['0']->right;
							}
						?>
						<tr>
							<?php 
							if($first_left_user!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($first_left_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" colspan="4" width="50%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img1" title="" src="<?php echo base_url('web_root/images/group/'.$image); ?>" />
								<table id="PlaceHolder_Img1infoT" class="infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link1" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $first_left_user; ?>"><?php echo $first_left_user; ?></a>
							</td>
							<?php }else {  ?>
							<td colspan="4" width="50%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $search; ?>&side=left"><img id="PlaceHolder_Img1" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php } ?>
							
							<?php 
							if($first_right_user!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($first_right_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
							?>
							<td class="tableTd" colspan="4" width="46%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img2" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img2infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link2" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $first_right_user; ?>"><?php echo $first_right_user; ?></a>
							</td>
							<?php } else {  ?>
							<td colspan="4" width="46%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $search; ?>&side=right"><img id="PlaceHolder_Img2" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php } ?>
						</tr>
						<tr>
							<td colspan="4" width="50%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line1.GIF" border="0">
							</td>
							<td colspan="4" width="50%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line1.GIF" border="0">
							</td>
						</tr>
						<?php  
							$data_first_left_user = tree_data($first_left_user);
							 
							 $second_left_user='';
							 $second_right_user='';
							 
							 if(!empty($data_first_left_user))
							{
								$second_left_user = $data_first_left_user['0']->left;
							}
							
							if(!empty($data_first_left_user) )
							{
								$second_right_user = $data_first_left_user['0']->right;
							} 
						?>
						<tr>
							<?php 
							if($second_left_user!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($second_left_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
							?>
							<td class="tableTd" colspan="2" width="25%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img3" title="" src="<?php echo base_url('web_root/images/group/'.$image); ?>" />
								<table id="PlaceHolder_Img3infoT" class="infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link3" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $second_left_user; ?>"><?php echo $second_left_user; ?></a>
							</td>
							<?php } else {  ?>
							<td colspan="2" width="25%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $first_left_user; ?>&side=left"><img id="PlaceHolder_Img3" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php } ?>
							 
							<?php if($second_right_user!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($second_right_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" colspan="2" width="25%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img4" title="" src="<?php echo base_url('web_root/images/group/'.$image);?>" />
								<table class="infoT" id="PlaceHolder_Img4infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link4" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $second_right_user; ?>"><?php echo $second_right_user; ?></a>
							</td>
							<?php } else {  ?>
							<td colspan="2" width="25%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $first_left_user; ?>&side=right"><img id="PlaceHolder_Img4" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php } ?>
							
							<?php  
							$data_second_leftr_user = tree_data($first_right_user);
							 $data_second_rightr_userleft='';
							 $data_second_rightr_userright='';

							 
							 if(!empty($data_second_leftr_user))
							{
								
								$data_second_rightr_userleft = $data_second_leftr_user['0']->left;
							}
							
							
							if(!empty($data_second_leftr_user))
							{
								$data_second_rightr_userright = $data_second_leftr_user['0']->right;
							} 

							 
							if($data_second_rightr_userleft!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($data_second_rightr_userleft);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" colspan="2" width="25%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img5" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img5infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link5" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_second_rightr_userleft; ?>"><?php echo $data_second_rightr_userleft; ?></a>
							</td>
							<?php }else {  ?>
							<td colspan="2" width="25%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $first_right_user; ?>&side=left"><img id="PlaceHolderblank_Img5" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php }  
									
							if($data_second_rightr_userright!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($data_second_rightr_userright);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
							?>
							<td class="tableTd" colspan="2" width="25%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img5" title="" src="<?php echo base_url('web_root/images/group/'.$image);?>" />
								<table class="infoT" id="PlaceHolder_Img5infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link5" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_second_rightr_userright; ?>"><?php echo $data_second_rightr_userright; ?></a>
							</td>
							<?php }else {  ?>
							<td colspan="2" width="25%" valign="top" align="center">
								<br>
								<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $first_right_user; ?>&side=right"><img id="PlaceHolder_Img6" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
								<br>
							</td>
							<?php } ?>
						</tr>
						<tr>
							<td colspan="2" width="25%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line2.GIF" border="0">
							</td>
							<td colspan="2" width="25%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line2.GIF" border="0">
							</td>
							<td colspan="2" width="25%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line2.GIF" border="0">
							</td>
							<td colspan="2" width="25%" valign="top" align="center">
								<img alt="" src="<?php echo base_url('web_root/images/group/') ;?>Line2.GIF" border="0">
							</td>
						</tr>
						<tr> 
							
							<?php  
							
							
							$data_third_first_user = tree_data($second_left_user);
							
							 $data_third_first_leftuser='';
							 $data_third_first_rightuser='';
							 
							 if(!empty($data_third_first_user))
							{
								$data_third_first_leftuser = $data_third_first_user['0']->left;
							}
							
							if(!empty($data_third_first_user) )
							{
								$data_third_first_rightuser = $data_third_first_user['0']->right;
							} 
							
							$data_third_firstsecond_user = tree_data($second_right_user);
							
							 $data_third_firstleft_user='';
							 $data_third_firstright_user='';
							 
							 if(!empty($data_third_firstsecond_user))
							{
								$data_third_firstleft_user = $data_third_firstsecond_user['0']->left;
							}
							
							if(!empty($data_third_firstsecond_user) )
							{
								$data_third_firstright_user = $data_third_firstsecond_user['0']->right;
							} 
							
							
							if($data_third_first_leftuser!='')
							{ 
								$result=$this->Form_model->showTreeMemberInfo($data_third_first_leftuser);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
								
								
							?>
							<td class="tableTd" width="12%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img7" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img7infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link7" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_third_first_leftuser; ?>"><?php echo $data_third_first_leftuser; ?></a>
							</td>
							<?php } else {  ?>
								 <td width="12%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $second_left_user; ?>&side=left"><img id="PlaceHolder_Img7" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
									<a id="PlaceHolder_Link8" href="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$PlaceHolder$Link8&quot;, &quot;&quot;, false, &quot;&quot;, &quot;/Registration.aspx?Id=yFqLqLu5Vq4=&amp;Side=R&quot;, false, true))"></a>
								</td>
							<?php } ?>
							
							<?php if($data_third_first_rightuser!='')
							{ 
								
								$result=$this->Form_model->showTreeMemberInfo($data_third_first_rightuser);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" width="12%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_thirdImg8" title="" src="<?php echo base_url('web_root/images/group/'.$image); ?>" />
								<table class="infoT" id="PlaceHolder_thirdImg8infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link7" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_third_first_rightuser; ?>"><?php echo $data_third_first_rightuser; ?></a>
							</td>
							<?php } else {  ?>
								 <td width="12%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $second_left_user; ?>&side=right"><img id="PlaceHolder_Img8" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } ?>
							
							<?php if($data_third_firstleft_user!='')
							{ 
								$result=$this->Form_model->showTreeMemberInfo($data_third_firstleft_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
							?>
							
							<td class="tableTd" width="11%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_firstleft_user7" title="" src="<?php echo base_url('web_root/images/group/'.$image); ?>" />
								<table class="infoT" id="PlaceHolder_firstleft_user7infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link7" href="javascript:__doPostBack('ctl00$PlaceHolder$Link7','')"><?php echo $data_third_firstleft_user; ?></a>
							</td>
							
							<?php } else {  ?>
								 <td width="11%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $second_right_user; ?>&side=left"><img id="PlaceHolder_Img9" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } ?>
							
							<?php if($data_third_firstright_user!='')
							{ 
								$result=$this->Form_model->showTreeMemberInfo($data_third_firstright_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							
							<td class="tableTd" width="14%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img71" title="" src="<?php echo base_url('web_root/images/group/'.$image);?>" />
								<table class="infoT" id="PlaceHolder_Img71infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link71" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_third_firstright_user; ?>"><?php echo $data_third_firstright_user; ?></a>
							</td>
							
							<?php } else {  ?>
								 <td width="14%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $second_right_user; ?>&side=right"><img id="PlaceHolder_Img10" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } ?>
							
							 
							<?php 
								$data_third_rightl_user = tree_data($data_second_rightr_userleft);
								
								$data_third_rightleft_user='';
								$data_third_rightright_user='';
								if(!empty($data_third_rightl_user))
								{
									$data_third_rightleft_user=$data_third_rightl_user['0']->left;
								}
								
								if(!empty($data_third_rightl_user))
								{
									$data_third_rightright_user=$data_third_rightl_user['0']->right;
								}
								
							if($data_third_rightleft_user!='')
							{
								$result=$this->Form_model->showTreeMemberInfo($data_third_rightleft_user);
								
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
							?>
							<td class="tableTd" width="11%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img72" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img72infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link11" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_third_rightleft_user; ?>"><?php echo $data_third_rightleft_user; ?></a>
							</td>
							<?php } else {  ?>
								<td width="11%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $data_second_rightr_userleft; ?>&side=left"><img id="PlaceHolder_Img11" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } 
							
								if($data_third_rightright_user!='')
								{
									$result=$this->Form_model->showTreeMemberInfo($data_third_rightright_user);
									
								$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" width="11%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img173" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img173infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>Right PV : </td><td><?php echo $result['right_pv']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link11" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $data_third_rightright_user; ?>"><?php echo $data_third_rightright_user; ?></a>
							</td>
							
							<?php } else {  ?>
								<td width="11%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $data_second_rightr_userleft; ?>&side=right"><img id="PlaceHolder_Img12" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } ?>
							
							<?php 
								$data_third_rightr_final=tree_data($data_second_rightr_userright);
								 
								$third_siderightleftfinaluser='';
								$third_rightrightfinaluser='';
								if(!empty($data_third_rightr_final))
								{
									$third_siderightleftfinaluser=$data_third_rightr_final['0']->left;
								}
								
								if(!empty($data_third_rightr_final))
								{
									$third_rightrightfinaluser=$data_third_rightr_final['0']->right;
								}
								if($third_siderightleftfinaluser!='')
								{
									$result=$this->Form_model->showTreeMemberInfo($third_siderightleftfinaluser);
									
									$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							<td class="tableTd" width="12%" valign="top" align="center">
								<br>
								<img id="PlaceHolder_Img74" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="PlaceHolder_Img74infoT"><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<br>
								<a id="PlaceHolder_Link13" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $third_siderightleftfinaluser; ?>"><?php echo $third_siderightleftfinaluser; ?></a>
							</td>
							<?php } else {  ?>
								<td width="12%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $data_second_rightr_userright; ?>&side=left"><img id="PlaceHolder_Img13" src="<?php echo base_url('web_root/images/group/') ;?>Black.png"></a>
									<br>
								</td>
							<?php } 
							
							if($third_rightrightfinaluser!='')
								{
									$result=$this->Form_model->showTreeMemberInfo($third_rightrightfinaluser);
									
									$image='Green.png';
								
								if($result['package_amount']=='Free Account')
								{
									$image='Red.png';
								}
								
							?>
							
							<td class="tableTd" width="13%" valign="top" align="center">
								<br>
								<img id="thirdRightfinalUser" title="" src="<?php echo base_url('web_root/images/group/'.$image) ;?>" />
								<table class="infoT" id="thirdRightfinalUserinfoT" ><tr><td>Name : </td><td><?php echo $result['name']; ?></td></tr><tr><td>Sponsor Id : </td><td><?php echo $result['sponsor_id']; ?></td></tr><tr><td>Left Total B.V : </td><td><?php echo $result['left_id']; ?></td></tr><tr><td>Right Total B.V : </td><td><?php echo $result['right_id']; ?></td></tr><tr><td>Left Upgrade Total ID : </td><td><?php echo $result['left_upgrade_total']; ?></td></tr><tr><td>Right Upgrade Total ID : </td><td><?php echo $result['right_upgrade_total']; ?></td></tr><tr><td>DOJ : </td><td><?php echo $result['doj']; ?></td></tr><tr><td>Package : </td><td><?php echo $result['package_amount']; ?></td></tr></table>
								<a id="PlaceHolder_Link13" href="<?php echo base_url('genealogy'); ?>?search=<?php echo $third_rightrightfinaluser; ?>"><?php echo $third_rightrightfinaluser; ?></a>
							</td>
							<?php } else {  ?>
								<td width="13%" valign="top" align="center">
									<br>
									<a  href="<?php echo base_url(); ?>registration?uniqueid=<?php echo $data_second_rightr_userright; ?>&side=left"><img id="PlaceHolder_Img14" src="<?php echo base_url('web_root/images/group/') ;?>Black.png">
									<br>
								</td>
							<?php } ?>
						</tr>
					</tbody>
				</table> 
            </div> 
    </section>
	
	

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<style>
.tableTd{position: relative;}
.tableTd img{height: 55px;}
.infoT{
	top: -255px;
	display:none;
	position:absolute;
	left: 50%;
	width: 260px;
	margin-left: -130px;
	z-index: 9999;
}
.infoT tr td:first-child{
	background: #82ac3e;
}
.infoT tr td:last-child{
	background: #318659;
}
.infoT td{
	border: 1px solid #bac0c5;
	padding: 4px 6px; 
	color: #fff;
	font-size: 11px;
}
.table-responsive {overflow: visible;}
@media only screen and (min-width: 320px) and (max-width: 767px) {
  .infoT{
	top: -240px;
	margin-left: -30px;
}  
.table-responsive {overflow-y: scroll;}
}
</style>
<script>
$('img').hover(function(ev){ 
	imgId=$(this).attr('id');
    $('#'+imgId+'infoT').stop(true,true).fadeIn(); 
},function(ev){
    $('#'+imgId+'infoT').stop(true,true).fadeOut();
}).mousemove(function(ev){
    $('#'+imgId+'infoT').css({left:ev.layerX+0,top:ev.layerY+0});
});
</script>
