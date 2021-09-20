<?php
class Cron_jobs extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('query');
		$this->load->model('Form_model');
	} 
	
	 public function createLevelIncome($table_name,$particular_id,$amount)
	 {		 
		
		 $commMember=array();
		
		 $date=date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

		 $result=$this->Form_model->getAllesult('*',$table_name,array('date(created_date)'=>$date));
 
		 $rajasthanResult=$this->Form_model->getAllesult('id,unique_id,left_id as left,right_id as right,created_date',$table_name,array());
 
		 if(!empty($rajasthanResult) && !empty($result))
		 {	 
		
			foreach($result as $value)
			{	 	 
				$teamResult=$this->chkTeam($rajasthanResult,$value['unique_id'],$table_name);
		 
				if(!empty($teamResult))
				{	
					foreach($teamResult as $teamResultValue)
					{
						$commAmount=0; 
						
						if($teamResultValue[5]>='1' && $teamResultValue[5]<='4')
						{
							$commAmount=($amount*5)/100;
						}
						else if($teamResultValue[5]>='5' && $teamResultValue[5]<='7')
						{
							$commAmount=($amount*4)/100;
						}
						else if($teamResultValue[5]>='8' && $teamResultValue[5]<='9')
						{
							$commAmount=($amount*3)/100;
						}
						else if($teamResultValue[5]=='10')
						{
							$commAmount=($amount*2)/100;
						}
						
						$commMember[]=array(
							'unique_id'=>$teamResultValue[1],
							'amount'=>$commAmount,
						);
					}
				}
				
				echo $value['unique_id']."<br>";
			}			
		 }
		 
		 if(!empty($result))
		 {
			  $sum = array_reduce($commMember, function ($a, $b) {
					isset($a[$b['unique_id']]) ? $a[$b['unique_id']]['amount'] += $b['amount'] : $a[$b['unique_id']] = $b; 
					return $a;
				});
				 
				if(!empty($sum))
				{
					foreach($sum as $value)
					{
						$memberId=$this->Form_model->getFieldValue('member_id','str_member',array('unique_id'=>$value['unique_id']));
						
						if((int) $memberId >='0' && $value['amount']>0)
						{
							$this->Form_model->insertWalletData($memberId,$particular_id,'cr',$value['amount']);
						}
					}
				}
		 }
		 
		 echo "Level Income Sent successfully";
		 die;
	 }
	 
	function chkTeam($rows,$parentId,$table_name)
	{
		$tree = $this->createTreeUser($rows,$parentId,$table_name); 
	 
		$farray=array();
		 
		  if(!empty($tree))
		  {
			 $finarray = array_flatten($tree);
			  
			$i=0;$main=0;
			foreach($finarray as $fg){
				if($i%6==0){
					$main=$main+1;
				}
				$farray[$main][]=$fg;
				$i++;
			}
		} 
		
		return $farray;
	} 
	 
	function createTreeUser(array $elements, $parentId,$table_name,$level=0)
	{		
		$branch=array();
		
		foreach($elements as $element)
		{
			if($element['right'] == $parentId)
			{ 	 
				$level++; 
				$element['level']=$level;
				
				$children = $this->createTreeUser($elements, $element['unique_id'],$table_name,$level);						 
				if ($children) { 
					$element[] = $children;					 
				} 	
 
				 if($level=='11' || ($element['id']=='1' && $table_name=='rajasthan_tree'))
			    {
			        break;
			    }
				
				$branch[] = $element;	 			
			}
			
			if($element['left'] == $parentId)
			{ 		
				$level++; 
				$element['level']=$level;
			   
				$children = $this->createTreeUser($elements, $element['unique_id'],$table_name,$level);	
				
				if ($children) { 
					$element[] = $children; 
				} 	 
				
			    if($level=='11' || ($element['id']=='1' && $table_name=='rajasthan_tree'))
			    {
			        break;
			    }
				
				 $branch[] = $element;	 			
			}  		
		}
		
		return $branch;	 
	}
	
	
	function getDirectChild(array $elements,$unique_id,$level,$side)
	{
		$branch = array();
	
		foreach($elements as $element)
		{
			$element['side']=$side;
			
			if($element['unique_id']==$unique_id)
			{
				
				$element['level']= $level; 
				$level++;
				
				if($element['left']!='')
				{
					
					$child=$this->getDirectChild($elements,$element['left'],$level,$side);
					
					if($child)
					{
						$element['left_id']=$child;
					} 
					
					if($level=='11')
					{
						break;
					}
				
				}
				
				if($element['right']!='')
				{		 
					$child=$this->getDirectChild($elements,$element['right'],$level,$side);
					
					if($child)
					{
						$element['right_id']=$child;
					} 
					
					if($level=='11')
					{
						break;
					}
						
				}
			
				$branch[] = $element;	 
			}		
		}
		 
		return $branch;
	}


	function createRoyaltyAchiver()
	{  
 
		$allMember=$this->Form_model->getAllesult('member_id,unique_id','str_member',array('member_id !='=>'1','royalty_ach_status'=>'0'));
		
		if(!empty($allMember))
		{
			foreach($allMember as $allMemberValue)
			{   
				$totalMember=$this->Form_model->getRowResult('COUNT(member_id) as total','str_member',array('referrer_id'=>$allMemberValue['unique_id']));
 
				if((int)$totalMember['total']>='30')
				{    
					$getMembeLastResult=$this->Form_model->getRowResultLimitOrderBy('created_date','str_member',array('referrer_id'=>$allMemberValue['unique_id']),'member_id','ASC','30');
				 
					 if(!empty($getMembeLastResult))
					 {
					     $endResult=end($getMembeLastResult);
						 $this->Form_model->updateData('member_id',$allMemberValue['member_id'],'str_member',array('royalty_ach_status'=>'1','royalty_ach_date'=>$endResult['created_date']));
					 }					
				}
				
				echo $allMemberValue['member_id']."<br>";
				 
			}
			
			echo "Royalty achiver status completed";
		}
	}

 
	function createRoyaltyIncomeOfLevel($table_name,$particular_id,$amount)
	{
		$oldStartDate=date('Y-m-d H:i:s', strtotime('-1 day', strtotime(date('Y-m-d'))));
		$oldEndDate=date('Y-m-d 23:59:59', strtotime('-1 day', strtotime(date('Y-m-d'))));

		$allMember=$this->Form_model->getAllesult('id,unique_id,left_id as left,right_id as right,created_date',$table_name,array()); 	
		
		$todayRegUser=$this->Form_model->getAllesult('unique_id,created_date',$table_name,array('created_date >='=>$oldStartDate,'created_date <='=>$oldEndDate)); 	 
		 
		if(!empty($todayRegUser))
		{
			$commMmember=array();
			
			foreach($todayRegUser as $todayRegUser)
			{	 
				$treeResult=$this->createTreeUser($allMember,$todayRegUser['unique_id'],$table_name,'0');
				
				 $farray=array(); $arr2=array();
		 
				  if(!empty($treeResult))
				  {
					  $finarray = array_flatten($treeResult);
					  
						$i=0;$main=0;
						foreach($finarray as $fg){
							if($i%6==0){
								$main=$main+1;
							}
							$farray[$main][]=$fg;
							$i++;
						}
						
					$arr2 = $this->Form_model->array_msort($farray, array('6'=>SORT_ASC,'5'=>SORT_ASC));
				
					// get total royalty achiver in current team of 10 level
					
					$royaltyAchArray=array();
					
					if(!empty($arr2))
					{
						foreach($arr2 as $arr2Value)
						{
							$royaltyResult=$this->Form_model->getRowResult('member_id,royalty_ach_date','str_member',array('unique_id'=>$arr2Value['1'],'royalty_ach_status'=>'1'));
							
							if(!empty($royaltyResult))
							{
								$royaltyAchArray[]=$royaltyResult;
							}
						}
						
						 
						if(!empty($royaltyAchArray))
						{				
							//calculate total Registration in By team
							
							$finalRoyaltyAchiver=array();
							
							foreach($royaltyAchArray as $royaltyAchArrayValue)
							{	 
								$royaltyAchDate=$royaltyAchArrayValue['royalty_ach_date'];
								
								$total=0;
								
								if($todayRegUser['created_date']>$royaltyAchDate && $todayRegUser['created_date']>=$oldStartDate && $todayRegUser['created_date']<=$oldEndDate)
								{
									$total++;
								}
								
								if($total>0)
								{
									$royaltyAchArrayValue['total']=$total;
									$finalRoyaltyAchiver[]=$royaltyAchArrayValue;
								}								
							}
 
							 $totalArrayLength=count($finalRoyaltyAchiver)-1;
							 
							 $incomeTotal=0;
							 
							 for($i=$totalArrayLength;$i>=0;$i--)
							 {								
								 $achData=$finalRoyaltyAchiver[$i];
								 
								 if($i==$totalArrayLength)
								 {
									  $incomeTotal=($achData['total']*$amount);
								 }
								else
								{	 
									$incomeTotal=(($achData['total']-$finalRoyaltyAchiver[$i+1]['total'])*$amount);
								}
								 
								 if($incomeTotal>0)
								 {
									 $totalAboveUsers=($i-0)+1;
									 $commAmount=(round((($incomeTotal*10)/100),2));
									 
									 if($totalAboveUsers>0)
									 {
										 $commAmount=round(($commAmount/$totalAboveUsers),2); 
									 }
									
									 for($a=$i;$a>=0;$a--)
									 {
										 $commMmember[]=array('member_id'=>$finalRoyaltyAchiver[$a]['member_id'],'amount'=>$commAmount);
									 }
								 }								 
							 }			 
						}
					}
				}				 
			}

			// send Rajasthan Royalty income
			
			if(!empty($commMmember))
			{
				$sum = array_reduce($commMmember, function ($a, $b) {
					isset($a[$b['member_id']]) ? $a[$b['member_id']]['amount'] += $b['amount'] : $a[$b['member_id']] = $b; 
					return $a;
				});
 
				if(!empty($sum))
				{
					foreach($sum as $sumValue)
					{
						$this->Form_model->insertWalletData($sumValue['member_id'],$particular_id,'cr',$sumValue['amount']); 
					}					
				}				
			}
		}
 			
		echo "Royalty Income Sent Sucessfully";
		die;
	}
	
	
	function createDirectIncome()
	{
		$this->createDirectIncomeWithLevel('rajasthan_tree','17','40');
		$this->createDirectIncomeWithLevel('national_tree','18','200');
		$this->createDirectIncomeWithLevel('international_tree','19','2000');
		$this->createDirectIncomeWithLevel('world_tree','20','10000');
		
		echo "Direct Income Sent Successfully";
		die;
	}
	
	function createDirectIncomeWithLevel($table_name,$particular_id,$amount)
	{
		$oldStartDate=date('Y-m-d H:i:s', strtotime('-1 day', strtotime(date('Y-m-d'))));

		$memberResult=$this->Form_model->getAllesult('unique_id',$table_name,array('date(created_date)'=>$oldStartDate));
	 
		if(!empty($memberResult))
		{
			$commMember=array();
			
			foreach($memberResult as $memberResultValue)
			{ 	
				$result=array();
				$result=$this->Form_model->createDirectIncome($memberResultValue['unique_id'],$table_name);
				
				if($result>0)
				{
					$commMember[]=array(
						'member_id'=>$result,
						'amount'=>$amount,
					 );
				}
			}	
			 
			if(!empty($commMember))
			{
				$sum = array_reduce($commMember, function ($a, $b) {
					isset($a[$b['member_id']]) ? $a[$b['member_id']]['amount'] += $b['amount'] : $a[$b['member_id']] = $b; 
					return $a;
				});
				 
				$sum=array_values($sum);
				
				if(!empty($sum))
				{
					foreach($sum as $sumValue)
					{
						$this->Form_model->insertWalletData($sumValue['member_id'],$particular_id,'cr',$sumValue['amount']);
					}
				}
			}
		}	 		
	} 
	
	function upgradeUserLevel()
	{
		$memberResult=$this->Form_model->getAllesult('*','str_member',array('member_id !='=>'1'));
		
		if(!empty($memberResult))
		{
			foreach($memberResult as $result)
			{
				// auto upgrade user level if user have sufficent balance for ur upgrade next level
					
				$userBalance=$this->Form_model->userTotalBalance($result['member_id']);
				
				if($userBalance>='100000' && $result['international_tour']=='1' && $result['national_tour']=='1' && $result['rajasthan_tour']=='1' && $result['world_tour']=='0')
				{
					$regdata['package_amount']='100000';
					$regdata['business_volume']='100000';
					$regdata['pv_value']='100000';
					$regdata['upgrade_date']=date("Y-m-d H:i:s");
					$regdata['world_tour']='1';
					$regdata['world_ach_date']=date("Y-m-d H:i:s");
					$regdata['next_upgrade_amount']='1000000';
					$this->Form_model->updateData('member_id',$result['member_id'],'str_member',$regdata);
					
					$this->Form_model->insertDatatInBinaryTree($result['unique_id'],'world_tree');
					
					$this->Form_model->insertWalletData($result['member_id'],'27','dr','100000');						
				}
				else if($userBalance>='10000' && $result['national_tour']=='1' && $result['rajasthan_tour']=='1' && $result['international_tour']=='0' && $result['world_tour']=='1')
				{
					$regdata['package_amount']='10000';
					$regdata['business_volume']='10000';
					$regdata['pv_value']='10000';
					$regdata['upgrade_date']=date("Y-m-d H:i:s");
					$regdata['international_tour']='1';
					$regdata['international_ach_date']=date("Y-m-d H:i:s");
					$regdata['next_upgrade_amount']='100000';
					$this->Form_model->updateData('member_id',$result['member_id'],'str_member',$regdata);
					
					$this->Form_model->insertDatatInBinaryTree($result['unique_id'],'international_tree');
					
					$this->Form_model->insertWalletData($result['member_id'],'26','dr','10000');
				}
				else if($userBalance>='1000' && $result['rajasthan_tour']=='1' && $result['national_tour']=='0' && $result['international_tour']=='0' && $result['world_tour']=='0')
				{
					$regdata['package_amount']='1000';
					$regdata['business_volume']='1000';
					$regdata['pv_value']='1000';
					$regdata['upgrade_date']=date("Y-m-d H:i:s");
					$regdata['national_tour']='1';
					$regdata['national_ach_date']=date("Y-m-d H:i:s");
					$regdata['next_upgrade_amount']='10000';
					$this->Form_model->updateData('member_id',$result['member_id'],'str_member',$regdata);
					
					$this->Form_model->insertDatatInBinaryTree($result['unique_id'],'national_tree');
		
					$this->Form_model->insertWalletData($result['member_id'],'25','dr','1000');
				}
			}
			
			echo "Update Level";
			die;
		}
	}
}

?>