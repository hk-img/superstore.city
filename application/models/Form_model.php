<?php
class Form_model extends CI_Model{
public function __construct() {
	parent::__construct(); 
		$this->load->helper('query'); 
	}
 
	 public function get_result($data,$tablename){
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();	
	}
	
	public function insert_data($data,$tableName){
		$this->db->insert($tableName,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;		
	}
	
	public function delete_data($data,$tableName){
		$this->db->where($data);
		$this->db->delete($tableName);		
	}
	
	
	public function update_data($table,$data,$whr_col,$whr_data){
		$this->db->where($whr_col,$whr_data);
		$this->db->update($table,$data);
		$afftectedRows=$this->db->affected_rows();
		return $afftectedRows;
	}
	
	public function sendMsg($mobile,$txtmsg)
	{
		$txtmsg=rawurlencode($txtmsg); 
		$url="http://sms.imgglobalinfotech.com/api/send_http.php?authkey=d7cf1d5ecc5bc5c55079a1bef1c4a4eb&mobiles=".$mobile."&message=$txtmsg&sender=IPSTOR&route=B";
		// $url="http://sms.imgglobalinfotech.com/api/send_http.php?authkey=80162d19d1cdd334bfb2e6bba869bcf7&mobiles=$mobile&message=$txtmsg&sender=CASHTM&route=B";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);
	}
	
	public function checkLogin()
	{
		 
		if($this->session->userdata('userlogin')!='')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function getTdsRatio()
	{
		$govtTaxRatio='0';
		$GovtTaxResult=$this->db->select('percentage')->where('ratio_id','2')->get('str_incomeratio')->result();
		if(!empty($GovtTaxResult))
		{
			if($GovtTaxResult['0']->percentage)
			{
				$govtTaxRatio=$GovtTaxResult['0']->percentage;
			}
		}
		return $govtTaxRatio;
	}
	
	public function getAdminTaxRatio()
	{
		$AdminTaxRatio='0';
		$AdminTaxResult=$this->db->select('percentage')->where('ratio_id','3')->get('str_incomeratio')->result();
		if(!empty($AdminTaxResult))
		{
			if($AdminTaxResult['0']->percentage)
			{
				$AdminTaxRatio=$AdminTaxResult['0']->percentage;
			}
		}
		return $AdminTaxRatio;
	}
	

	
	/*==Genrated binary Income==*/
	
	public function getBinaryIncome()
	{
		$binaryIncome='0';
		$binaryIncomeResult=$this->db->select('percentage')->where('ratio_id','1')->get('str_incomeratio')->result();
		if(!empty($binaryIncomeResult))
		{
			if($binaryIncomeResult['0']->percentage)
			{
				$binaryIncome=$binaryIncomeResult['0']->percentage;
			}
		}
		return $binaryIncome;
	}
	 
	
	public function checkBinaryIncomeForUser($uniqueId,$getTotalLeftUserPv,$getTotalRightUserPv){		 
		  
	 
		$getReferreMemberId=getIdByUniqueId($uniqueId);
		$toalOfgivenPairIncome=$this->genratedPairByUserSum($getReferreMemberId);
		
		$getTotalLeftUserPv=$getTotalLeftUserPv-$toalOfgivenPairIncome;
		$getTotalRightUserPv=$getTotalRightUserPv-$toalOfgivenPairIncome;
		
		/*=created user pair==*/
		$createdPair=(min($getTotalLeftUserPv,$getTotalRightUserPv));
							
		
		
		/*=get actual pair for created binaryIncome==*/
		
		
		if($createdPair>0)
		{
			$this->genratedBinaryIncome($createdPair,$getReferreMemberId,$getTotalLeftUserPv,$getTotalRightUserPv);
		}
	}
	/*==Sum of total pair created by user===*/

	public function genratedPairByUserSum($userId)
	{
		$totalPairs=0;
		$netPairCond=array(
			'user_id'=>$userId,
			'date(created_date) !='=>date("Y-m-d"),
		);
		$result=$this->db->select('SUM(net_pairs)')->where($netPairCond)->get('str_userincome')->result(); 
		$fieldName="SUM(net_pairs)";
		if(!empty($result))	
		{
			if($result['0']->$fieldName!='')
			{
				$totalPairs=$result['0']->$fieldName;
			}
		}
		return $totalPairs;
	}
	

	public function genratedBinaryIncome($pair,$userId,$leftPv,$rightPv)
	{
		$carryLeftPv=$leftPv-$pair;
		$carryRightPv=$rightPv-$pair;
		$binaryIncome=$this->getBinaryIncome();
		$govtTax=$this->getTdsRatio();
		$AdminTax=$this->getAdminTaxRatio();
		$userCapping=$this->getUserCapping($userId);
		$pairAmount=$pair;
		$createdBinaryIncome=round((($pairAmount*$binaryIncome)/100),2);
 
		/*===calculation of gross Amount==*/
		$createdGrossAmount=0;
		$createdGrossAmount=$createdBinaryIncome;
		
		/*===calculation of Govt.Tax  Amount==*/
		$createdtds_Amount=0;
		$createdtds_Amount=round((($createdGrossAmount*$govtTax)/100),2);
		
		/*===calculation of Admin.Tax  Amount==*/
		$createdAdmin_Amount=0;
		$createdAdmin_Amount=round((($createdGrossAmount*$AdminTax)/100),2);
		
		/*===calculation of Net Amount  Amount==*/
		$netAmount=0;
		$netAmount=$createdGrossAmount-($createdtds_Amount+$createdAdmin_Amount);
		
		if($createdBinaryIncome>0)
		{
			$incomeCond=array(
				'user_id'=>$userId,
				'date(created_date)'=>date("Y-m-d"),
			);
			
			$cchkCurrentPairIncome=$this->db->select('income_id,binary_income')->where($incomeCond)->get('str_userincome')->row();
			
			$incomeArray=array(
				'user_id'=>$userId,
				'left_pv'=>$leftPv,
				'right_pv'=>$rightPv,
				'carry_leftpv'=>$carryLeftPv,
				'carry_rightpv'=>$carryRightPv,
				'net_pairs'=>$pair,
				'binary_income'=>$createdBinaryIncome,
				'gross_amount'=>$createdGrossAmount,
				'tds_amount'=>$createdtds_Amount,
				'admin_amount'=>$createdAdmin_Amount,
				'net_amount'=>$netAmount,
			);
			
			/*==get final amount by capping==*/

			if($createdBinaryIncome>$userCapping)
			{
				$createdBinaryIncome=$userCapping;
			}
		
			if(empty($cchkCurrentPairIncome))
			{
				$this->insert_data($incomeArray,'str_userincome');
				$this->addMoneyInWallet($userId,'1','cr',$createdBinaryIncome);				
			}
			else
			{ 
				$currentDateOldBinaryIncome=$cchkCurrentPairIncome->binary_income;
				$newCreatedBinaryIncome=$createdBinaryIncome-$currentDateOldBinaryIncome;
				if($newCreatedBinaryIncome>0)
				{
					$this->addMoneyInWallet($userId,'1','cr',$newCreatedBinaryIncome);	
				}
				$this->update_data('str_userincome',$incomeArray,'income_id',$cchkCurrentPairIncome->income_id);
			 }
		}
	}
	
	public function addMoneyInWallet($userId,$particularId,$type,$amount,$status='SUCCESS')
	{
		if($amount>0)
		{
				 
			$govtTax=$this->getTdsRatio();
			$AdminTax=$this->getAdminTaxRatio();
		
		
			/*===calculation of Govt.Tax  Amount==*/
		$tds_amount=0;
		$tds_amount=round((($amount*$govtTax)/100),2);
		
		/*===calculation of Admin.Tax  Amount==*/
		$admin_amount=0;
		$admin_amount=round((($amount*$AdminTax)/100),2);
		
		/*===calculation of Net Amount  Amount==*/ 
		$netAmount=0;
		$netAmount=$amount-($tds_amount+$admin_amount);
		
		if($type=='dr'){

			$walletArray=array(
				'user_id'=>$userId, 
				'particular_id'=>$particularId,
				'type'=>$type,
				'amount'=>$amount,
				'tds_amount'=>'0',
				'admin_amount'=>'0',
				'net_amount'=>$amount,
				'status'=>$status,
			);
		}else{

			$walletArray=array(
				'user_id'=>$userId, 
				'particular_id'=>$particularId,
				'type'=>$type,
				'amount'=>$amount,
				'tds_amount'=>$tds_amount,
				'admin_amount'=>$admin_amount,
				'net_amount'=>$netAmount,
				'status'=>$status,
			);
		}			
			
		 $this->insert_data($walletArray,'str_wallet');	
		}
			
	}
	
	public function totalBinaryIncoByMemberId($id)
	{
		$fieldName="SUM(binary_income)";
		$result=$this->db->select('SUM(binary_income)')->where('user_id',$id)->get('str_userincome')->row();
		 
		if(!empty($result->$fieldName))
		{
			return $result->$fieldName;
		}
		else
		{
			return "0.00";
		}
	}
	
	public function getLeaderShipTaxRatio()
	{
		$leadershipRatio='0';
		$leadership=$this->db->select('percentage')->where('ratio_id','4')->get('str_incomeratio')->result();
		if(!empty($leadership))
		{
			if($leadership['0']->percentage)
			{
				$leadershipRatio=$leadership['0']->percentage;
			}
		}
		return $leadershipRatio;
	}
	
	public function getLeaderShipBoostTaxRatio()
	{
		$leadershipRatio='0';
		$leadership=$this->db->select('percentage')->where('ratio_id','5')->get('str_incomeratio')->result();
		if(!empty($leadership))
		{
			if($leadership['0']->percentage)
			{
				$leadershipRatio=$leadership['0']->percentage;
			}
		}
		return $leadershipRatio;
	}
	
	public function createdTotalLeadershipBonus($userId,$type=null)
	{
		$totalBonus=0;
		
		if($type=='current')
		{
			$leaderCond=array(
				'user_id'=>$userId, 
			);
		
		}
		else
		{
			$leaderCond=array(
				'user_id'=>$userId,
				'date(created_date) !='=>date("Y-m-d"),
			);
		}
		$result=$this->db->select('SUM(leadership_amount)')->where($leaderCond)->get('str_userincome')->result(); 
		$fieldName="SUM(leadership_amount)";
		if(!empty($result))	
		{
			if($result['0']->$fieldName!='')
			{
				$totalBonus=$result['0']->$fieldName;
			}
		}
		return $totalBonus;
	}
	
	public function genratedLeadershipIncome($leadAmt,$userId)
	{  
		$govtTax=$this->getTdsRatio();
		$AdminTax=$this->getAdminTaxRatio(); 
		$leadatio=$this->getLeaderShipTaxRatio(); 
		$createdLeadershipIncome=round((($leadAmt*$leadatio)/100),2);
		$alreadyGivenTotalBonus=$this->createdTotalLeadershipBonus($userId,'current');
	 
		if($createdLeadershipIncome>$alreadyGivenTotalBonus)
		{
			 
			$incomeCond=array(
				'user_id'=>$userId,
				'date(created_date)'=>date("Y-m-d"),
			);
			$cchkCurrentIncome=$this->db->select('income_id,leadership_amount,gross_amount')->where($incomeCond)->get('str_userincome')->row();
			
			if(!empty($cchkCurrentIncome))
			{
				$oldGivenLeaderShipBonus=$this->createdTotalLeadershipBonus($userId); 
				$createdBonus=$createdLeadershipIncome-$oldGivenLeaderShipBonus;
				$grossAmount=($cchkCurrentIncome->gross_amount)+$createdBonus;  
				
				/*===calculation of Govt.Tax  Amount==*/
				$createdtds_Amount=0;
				$createdtds_Amount=round((($grossAmount*$govtTax)/100),2);
				
				/*===calculation of Admin.Tax  Amount==*/
				$createdAdmin_Amount=0;
				$createdAdmin_Amount=round((($grossAmount*$AdminTax)/100),2);
				
				/*===calculation of Net Amount  Amount==*/
				$netAmount=0;
				$netAmount=$grossAmount-($createdtds_Amount+$createdAdmin_Amount);
				
				$incomeArray=array(
					'user_id'=>$userId,     
					'leadership_amount'=>$createdBonus,
					'gross_amount'=>$grossAmount,
					'tds_amount'=>$createdtds_Amount,
					'admin_amount'=>$createdAdmin_Amount,
					'net_amount'=>$netAmount,
				);
			 
				$this->update_data('str_userincome',$incomeArray,'income_id',$cchkCurrentIncome->income_id);
				
				/*==Insert wallet data==*/
				
				$newWalletAmount=$createdLeadershipIncome-$alreadyGivenTotalBonus;
				$this->addMoneyInWallet($userId,'4','cr',$newWalletAmount);	
			}
			
			 
		}
	}
	
	
	public function createdTotalLeadershipBoostBonus($userId,$type=null)
	{
		$totalBonus=0;
		
		if($type=='current')
		{
			$leaderCond=array(
				'user_id'=>$userId, 
			);
		
		}
		else
		{
			$leaderCond=array(
				'user_id'=>$userId,
				'date(created_date) !='=>date("Y-m-d"),
			);
		}
		$result=$this->db->select('SUM(leadbooster_amount)')->where($leaderCond)->get('str_userincome')->result(); 
		$fieldName="SUM(leadbooster_amount)"; 
		if(!empty($result))	
		{
			if($result['0']->$fieldName!='')
			{
				$totalBonus=$result['0']->$fieldName;
			}
		}
		return $totalBonus;
	}
	
	public function genratedLeadershipBoosterIncome($leadAmt,$userId)
	{  
		$govtTax=$this->getTdsRatio();
		$AdminTax=$this->getAdminTaxRatio(); 
		$leadatio=$this->getLeaderShipBoostTaxRatio(); 
		$createdLeadershipIncome=round((($leadAmt*$leadatio)/100),2);
		$alreadyGivenTotalBonus=$this->createdTotalLeadershipBoostBonus($userId,'current');
	 
		if($createdLeadershipIncome>$alreadyGivenTotalBonus)
		{
			 
			$incomeCond=array(
				'user_id'=>$userId,
				'date(created_date)'=>date("Y-m-d"),
			);
			$cchkCurrentIncome=$this->db->select('income_id,leadbooster_amount,gross_amount')->where($incomeCond)->get('str_userincome')->row();
			
			if(!empty($cchkCurrentIncome))
			{
				$oldGivenLeaderShipBonus=$this->createdTotalLeadershipBoostBonus($userId); 
				$createdBonus=$createdLeadershipIncome-$oldGivenLeaderShipBonus;
				$grossAmount=($cchkCurrentIncome->gross_amount)+$createdBonus;  
				
				/*===calculation of Govt.Tax  Amount==*/
				$createdtds_Amount=0;
				$createdtds_Amount=round((($grossAmount*$govtTax)/100),2);
				
				/*===calculation of Admin.Tax  Amount==*/
				$createdAdmin_Amount=0;
				$createdAdmin_Amount=round((($grossAmount*$AdminTax)/100),2);
				
				/*===calculation of Net Amount  Amount==*/
				$netAmount=0;
				$netAmount=$grossAmount-($createdtds_Amount+$createdAdmin_Amount);
				
				$incomeArray=array(
					'user_id'=>$userId,     
					'leadbooster_amount'=>$createdBonus,
					'gross_amount'=>$grossAmount,
					'tds_amount'=>$createdtds_Amount,
					'admin_amount'=>$createdAdmin_Amount,
					'net_amount'=>$netAmount,
				);
			 
				$this->update_data('str_userincome',$incomeArray,'income_id',$cchkCurrentIncome->income_id);
				
				/*==Insert wallet data==*/
				
				$newWalletAmount=$createdLeadershipIncome-$alreadyGivenTotalBonus;
				$this->addMoneyInWallet($userId,'5','cr',$newWalletAmount);	
			}						 
		}
	 }
	 
	 
	 
		/*==start upline income code==*/
			public function getUplineTaxRatio()
			{
				$uplineRatio='0';
				$upline=$this->db->select('percentage')->where('ratio_id','6')->get('str_incomeratio')->result();
				if(!empty($upline))
				{
					if($upline['0']->percentage)
					{
						$uplineRatio=$upline['0']->percentage;
					}
				}
				return $uplineRatio;
			}
	
		public function totalUserUplineBonus($userId)
		{
				$uplineCond=array(
					'user_id'=>$userId,
					'date(created_date)'=>date("Y-m-d"),
				);
				$result=$this->db->select('SUM(upline_bonus)')->where($uplineCond)->get('str_userincome')->result(); 
				$fieldName="SUM(upline_bonus)";
				$totalBonus=0;
				if(!empty($result))	
				{
					if($result['0']->$fieldName!='')
					{
						$totalBonus=$result['0']->$fieldName;
					}
				}
				return $totalBonus;
		}
		public function chkBinaryInDays($userId)
		{
			$backDate=date('Y-m-d', strtotime('-7 days'));
			$result=$this->db->select('income_id')->where(array('date(created_date) >='=>$backDate,'user_id'=>$userId))->get('str_userincome')->result();
			return $result;
			die;
		}
		
		public function uplineIncomeCode($userId,$binaryIncome)
		{
			$commDate=$this->stratCommDate();
			$getUniqueCode=getUniqueIdById($userId); 
			$getAllReferalResult=$this->db->select('member_id')->where('referrer_id',$getUniqueCode)->where('upgrade_date',$commDate)->get('str_member')->result();
			
			$totalBinaryUser=array();
			if(!empty($getAllReferalResult))
			{
				 foreach($getAllReferalResult as $getAllReferalResultKey=>$getAllReferalResultValue)
				{
					$chkUserBinary=$this->chkBinaryInDays($getAllReferalResultValue->member_id);
					if(!empty($chkUserBinary))
					{
						$totalBinaryUser[]=$getAllReferalResultValue->member_id;
					}
				}
		 	}
			
			
			/*===Given upline Bonus===*/
			
			 
			if(!empty($totalBinaryUser))
			{
				$govtTax=$this->getTdsRatio();
				$AdminTax=$this->getAdminTaxRatio(); 
				$uplineratio=$this->getUplineTaxRatio(); 
				
				$uplineAmount=round((($binaryIncome*$uplineratio)/100),2);
				
				$eligUplineUser=count($totalBinaryUser);
				$createdAmount=round(($uplineAmount/$eligUplineUser),2);
				foreach($totalBinaryUser as $totalBinaryUser)
				{
					$alreadyGivenUpline=$this->totalUserUplineBonus($totalBinaryUser);
					$incomeCond=array(
						'user_id'=>$totalBinaryUser,
						'date(created_date)'=>date("Y-m-d"),
					);
					$cchkCurrentIncome=$this->db->select('income_id,upline_bonus,gross_amount')->where($incomeCond)->get('str_userincome')->row();
					
					
					if(!empty($cchkCurrentIncome) && $cchkCurrentIncome->upline<$createdAmount)
					{
						
						$grossAmount=($cchkCurrentIncome->gross_amount)+$createdAmount; 
						
							/*===calculation of Govt.Tax  Amount==*/
							$createdtds_Amount=0;
							$createdtds_Amount=round((($grossAmount*$govtTax)/100),2);
							
							/*===calculation of Admin.Tax  Amount==*/
							$createdAdmin_Amount=0;
							$createdAdmin_Amount=round((($grossAmount*$AdminTax)/100),2);
							
							/*===calculation of Net Amount  Amount==*/
							$netAmount=0;
							$netAmount=$grossAmount-($createdtds_Amount+$createdAdmin_Amount);
							
							$incomeArray=array(
								'user_id'=>$userId,     
								'upline_bonus'=>$createdAmount,
								'gross_amount'=>$grossAmount,
								'tds_amount'=>$createdtds_Amount,
								'admin_amount'=>$createdAdmin_Amount,
								'net_amount'=>$netAmount,
							);
							
							/*==Insert wallet data==*/
						 $alreadyGivenTotalBonus=$cchkCurrentIncome->upline;
						$newWalletAmount=$createdAmount-$alreadyGivenTotalBonus;
						$this->addMoneyInWallet($userId,'6','cr',$newWalletAmount);	
						
						$this->update_data('str_userincome',$incomeArray,'income_id',$cchkCurrentIncome->income_id);
					  }
				}
			 		
			}	
		}
		
		/*==end upline income code==*/
		
		/*===club code===*/
		
		public function totalSilverClubIncome($userId)
		{
			$totalAmount=0;
			$result=$this->db->select('SUM(amount)')->where(array('particular_id'=>'7','user_id'=>$userId))->get('str_clubincome')->result(); 
			$fieldName="SUM(amount)";
			if(!empty($result))	
			{
				if($result['0']->$fieldName!='')
				{
					$totalAmount=$result['0']->$fieldName;
				}
			}
			
			return $totalAmount;
		}
		
		public function getTotalTurnover($startDate,$endDate)
		{
			$totalAmount='0.00';
			$result=$this->db->select('SUM(package_amount) as totalAmount')->where(array('date(created_date) >='=>$startDate,'date(created_date) <='=>$endDate))->get('str_turnover_detail')->row(); 
			
			if(!empty($result))	
			{
				if($result->totalAmount!='')
				{
					$totalAmount=$result->totalAmount;
				}
			}
			return $totalAmount;
		 }
		 
		 public function getTotalreferalBv($unique_id)
		 {
			 $commDate=$this->stratCommDate();
			 $fieldName="SUM(business_volume)";
			$totalAmount=0;
			$result=$this->db->select('SUM(business_volume)')->where(array('status'=>'1','referrer_id'=>$unique_id,'business_volume >='=>'500','upgrade_date>='=>$commDate))->get('str_member')->row(); 
			 
			 if(!empty($result))	
			{
				if($result->$fieldName!='')
				{
					$totalAmount=$result->$fieldName;
				}
			}
			return $totalAmount;
		 }
		 
	 public function getsilverBonusRatio()
	{
		$silverRatio='0';
		$silver=$this->db->select('percentage')->where('ratio_id','7')->get('str_incomeratio')->row();
		if(!empty($silver))
		{
			if($silver->percentage)
			{
				$silverRatio=$silver->percentage;
			}
		}
		return $silverRatio;
	}
	
	 public function getstarBonusRatio()
	{
		$starRatio='0';
		$star=$this->db->select('percentage')->where('ratio_id','8')->get('str_incomeratio')->row();
		if(!empty($star))
		{
			if($star->percentage)
			{
				$starRatio=$star->percentage;
			}
		}
		return $starRatio;
	}
	
	 public function getemerldBonusRatio()
	{
		$emerldRatio='0';
		$emerld=$this->db->select('percentage')->where('ratio_id','9')->get('str_incomeratio')->row();
		if(!empty($emerld))
		{
			if($emerld->percentage)
			{
				$emerldRatio=$emerld->percentage;
			}
		}
		return $emerldRatio;
	}
	
	public function chkUserClubIncome($userId,$clubId)
	{ 
		$amount=0;
		$fieldName="SUM(amount)";
		$result=$this->db->select('SUM(amount)')->where(array('user_id'=>$userId,'particular_id'=>$clubId))->get('str_wallet')->row();
		 
		if(!empty($result))
		{
			if($result->$fieldName!='' && $result->$fieldName>0)
			{
				$amount=$result->$fieldName;
			} 
		}
		else
		{
			$amount="0.00";
		}
		return $amount;
	}
	
	/*==get start comm date===*/
	
	public function stratCommDate()
	{
		$result=$this->db->where('comm_id','1')->get('str_startcommdate')->row();
		return $result->comm_date;
	}
	 
	
	/*===Get total cr balance===*/
	
	public function totalCrBalance($userId)
	{
	    $balance=0;
	    $result=$this->db->select('SUM(net_amount)')->where('status','SUCCESS')->where('user_id',$userId)->where('type','cr')->get('str_wallet')->row();
	    $field='SUM(net_amount)';
	    if(!empty($result))
	    {
	        if($result->$field!='')
	        {
	            $balance=$result->$field;
	        }
	    }
	    
	    return $balance;
	}
	
	public function totalGrossBalance($userId)
	{
	    $balance=0;
	    $result=$this->db->select('SUM(amount)')->where('user_id',$userId)->where('type','cr')->get('str_wallet')->row();
	    $field='SUM(amount)';
	    if(!empty($result))
	    {
	        if($result->$field!='')
	        {
	            $balance=$result->$field;
	        }
	    }
	    
	    return $balance;
	}
		
	public function confirmGrossBalance($userId)
	{
	    $balance=0;
	    $cond="type='dr' and status='SUCCESS' and user_id='".$userId."'";
	    $result=$this->db->select('SUM(amount) as total')->where($cond)->get('str_wallet')->row();

	    if(!empty($result))
	    {
	        if($result->total!='')
	        {
	            
	            $balance=$result->total;
	        }
	    }
	    
	    return $balance;
	}
	
	public function confirmPendingBalance($userId)
	{
	    $balance=0;
	    $cond="type='dr' and status='PENDING' and user_id='".$userId."'";
	    $result=$this->db->select('SUM(amount) as total')->where($cond)->get('str_wallet')->row();

	    if(!empty($result))
	    {
	        if($result->total!='')
	        {
	            
	            $balance=$result->total;
	        }
	    }
	    
	    return $balance;
	}
	
	
	public function confirmBalance($userId)
	{
	    $balance=0;
	    $result=$this->db->select('SUM(net_amount)')->where('status','SUCCESS')->where('user_id',$userId)->where('type','dr')->get('str_wallet')->row();
	    $field='SUM(net_amount)';
	    if(!empty($result))
	    {
	        if($result->$field!='')
	        {
	            $balance=$result->$field;
	        }
	    }
	    
	    return $balance;
	}
	
	public function getParticularName($id)
	{
	    $name='No Filled';
	    $result=$this->db->where('particular_id',$id)->get('str_particularname')->row();
	    if(!empty($result))
	    {
	        if($result->name!='')
	        {
	            $name=ucfirst($result->name);
	        }
	    }
	    return $name;
	}
	
	 public function createdTotalPairOfUser($userId)
	 {
		$result=$this->db->select('SUM(net_pairs) as totalPairs')->where('user_id',$userId)->get('str_userincome')->row(); 
		 
		$totalPairs=0;
		if(!empty($result) && $result->totalPairs>0)
		{
			$totalPairs=$result->totalPairs;
		}
		return $totalPairs;
	 }
	 
	 
	 /*====Check already given Reward===*/
	 
	 public function checkAlreadyGivenReward($type,$userId)
	 {
		 $result=$this->db->select('reward_id')->where(array('user_id'=>$userId,'reward_type'=>$type))->get('achieve_reward')->result();
		 
		 if(!empty($result))
		 {
			 return "1";
		 }
		 else
		 {
			 return "0";
		 }
	 }
	 
	 
	 public function getTotalbusinessVolumeById($userid,$memberDate='')
	 {
		 $amount='0';

		$result=$this->db->select('business_amount')->where('user_id',$userid)->get('str_turnover_detail')->row()->business_amount;
		return $amount;
	 }
	 

	 
	function getTotalLeftBusinessVolume($uniqueId,$side)
	{
		// $leftChild=getBothleftAndrightChild($uniqueId,$side);
		
		//  $totalLeftPv=0;
		//  if(!empty($leftChild))
		//  {
		// 	 foreach($leftChild as $leftChild)
		// 	 {
		// 		 $memberId='0';
		// 		 $memberId=getIdByUniqueId($leftChild[0]);
		// 		 $totalLeftPv+=$this->getTotalbusinessVolumeById($memberId);
		// 	 }
		//  }
		
		if($side=='left'){

			$result=$this->db->select('leftteam_value')->where('unique_id',$uniqueId)->get('str_member')->row()->leftteam_value;
		}else{

			$result=$this->db->select('rightteam_value')->where('unique_id',$uniqueId)->get('str_member')->row()->rightteam_value;
		}
		
		return $result;
	}
	
	function getTotalRepurchaeBv($uniqueId,$side)
	{
		$sideChild=getBothleftAndrightChild($uniqueId,$side);
		
		$amount=0;
		
		if(!empty($sideChild))
		{
			foreach($sideChild as $sideChildValue)
			{
				$userId=getIdByUniqueId($sideChildValue[0]);
				
				$productResult=$this->db->select('SUM(dealer_price) as total')->where('user_id',$userId)->get('repurchase_product')->row_array();
				
				$amount+=(float)$productResult['total'];
			}
		}
		
		return $amount;
	}

	
	function showTreeMemberInfo($userId)
	{
		
		$result=$this->db->where('unique_id',$userId)->get('str_member')->row();

		if($result->package_amount>'0')
		{
			$type=$result->package_amount;
		}
		else
		{
			$type="Free Account";
		} 
		$leftIdCount=countTotalLeftRightIdBYSide($userId,'left'); 
		$rightIdCount=countTotalLeftRightIdBYSide($userId,'right');;
		
		$LefttotalActivateId=getTotalActiveId($userId,'left');
		$RighttotalActivateId=getTotalActiveId($userId,'right');
		$totalLeftId=countTotalLeftRightPvBYSide($userId,'left');
		$totalRightId=countTotalLeftRightPvBYSide($userId,'right');
		$data=array(
			'name'=>ucfirst($result->name),
			'sponsor_id'=>$result->referrer_id, 
			'left_id'=>$this->getTotalLeftBusinessVolume($result->unique_id,'left'),
			'right_id'=>$this->getTotalLeftBusinessVolume($result->unique_id,'right'),
			'left_upgrade_total'=>$LefttotalActivateId,
			'right_upgrade_total'=>$RighttotalActivateId,
			'left_pv'=>$totalLeftId,
			'right_pv'=>$totalRightId,
			'doj'=>date("d/m/Y", strtotime($result->created_date)),
			'package_amount'=>$type,
		);
		return $data;
	}
	
	public function totalUserWalletAmount($userId)
	{
		$amount='0';
		$result=$this->db->select('SUM(amount) as total')->where(array('date(created_date)'=>date("Y-m-d"),'user_id'=>$userId))->get('str_wallet')->row()->total;
		if($result!='')
		{
			$amount=$result;
		}
		return $amount;
	}
	
	
	public function getUserCapping($userId)
	{
		$amount='4000';
		// $result=$this->db->select('pv_value')->where('member_id',$userId)->get('str_member')->row()->pv_value;
		// if($result!='')
		// {
		// 	$amount=$result;
		// }
		return $amount;
	}
	
	public function getTotalUserPurchase($userId)
	{
		$productResult=$this->db->select('SUM(dealer_price) as total')->where('user_id',$userId)->get('repurchase_product')->row_array();
				
		return $productResult['total'];
		
		die;
	}
	
	public function getProductAmountById($productId,$qty)
	{
		$price=0;$dpPrice=0;$bvPrice=0;
		 
		$productArray=array_filter($productId);
		$qtyArray=array_filter($qty);

		if(!empty($productArray) && (count($productArray)==count($qtyArray)))
		{ 
	
			$index=0;
			
			foreach($productArray as $productArrayValue)
			{
				$result=$this->db->where('id',$productArrayValue)->get('products')->row_array();
				
				if(!empty($result))
				{
					$price+=(((float)($result['price']))*((int) $qtyArray[$index]));
					$dpPrice+=(((float)($result['dealer_price']))*((int) $qtyArray[$index]));
					$bvPrice+=(((float)($result['business_volume']))*((int) $qtyArray[$index]));
				}
				
				$index++;
			}		 
		}
		
		$data=array(
			'price'=>(float) $price,
			'dealer_price'=>(float) $dpPrice,
			'business_volume'=>(float) $bvPrice,
		);
			
		return $data;
	}
	
	function getRankName($userId)
	{
		$totalBinaryPair=$this->db->select('SUM(net_pairs) as total')->where('user_id',$userId)->get('str_userincome')->row()->total;
		
		if($totalBinaryPair>=20000 && $totalBinaryPair<50000)
		{
			return "Rising Star"; 
		}
		elseif($totalBinaryPair>=50000 && $totalBinaryPair<200000)
		{
			return "Star"; 
		}
		elseif($totalBinaryPair>=200000 && $totalBinaryPair<500000)
		{
			return "Silver"; 
		}
		elseif($totalBinaryPair>=500000 && $totalBinaryPair<1000000)
		{
			return "Gold"; 
		}
		elseif($totalBinaryPair>=1000000 && $totalBinaryPair<2000000)
		{
			return "Platinum"; 
		}
		elseif($totalBinaryPair>=2000000 && $totalBinaryPair<5000000)
		{
			return "Ruby"; 
		}
		elseif($totalBinaryPair>=5000000 && $totalBinaryPair<20000000)
		{
			return "Diamond"; 
		}
		elseif($totalBinaryPair>=20000000 && $totalBinaryPair<50000000)
		{
			return "Double Diamond"; 
		}
		elseif($totalBinaryPair>=50000000 && $totalBinaryPair<100000000)
		{
			return "Royal Diamond"; 
		}
		elseif($totalBinaryPair>=100000000 && $totalBinaryPair<200000000)
		{
			return "Blue Diamond"; 
		}
		elseif($totalBinaryPair>=200000000)
		{
			return "Crow Diamond"; 
		}
		else
		{
			return "";
		}
	}
 
}
?>