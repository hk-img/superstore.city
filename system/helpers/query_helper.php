<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function root(){
	$root = base_url();
	return $root;
}
 
 
function startcommDate()
 {
	 $date='';
	foreach(SelectQuery('comm_date','str_startcommdate','comm_id','1') as $raa) $date=$raa->comm_date;
	return $date;
 }
 
function OrderBy_Query($field,$table,$whr_col,$whr_condiition,$condition){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select($field);
	$ci->db->from($table);
		if($whr_col !=''){
		$ci->db->order_by($whr_col, $whr_condiition);
	}
	if($condition !=''){
		$ci->db->where($condition);
	}

	$query = $ci->db->get();
	return $query->result();
}
function shweta_select_thdistinct($field,$table,$whr){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->distinct();
	$ci->db->select($field);
	if($whr !=""){
	$ci->db->where($whr);
	}
	$query =$ci->db->get($table);
	return $query->result();
}
 function newslugend($slug){
	$slug=str_replace("&","and",$slug);
	$text = preg_replace('~[^\\pL\d]+~u', '_', $slug);
	$text = trim($text, '_');  // trim
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);  // transliterate
	$text = strtolower($text);  // lowercase
	$text = preg_replace('~[^-\w]+~', '', $text);  // remove unwanted characters
	$text=str_replace("_","-",$text);
	return $slug=$text;
 }
function SelectQuery($field,$table,$whr_col,$whr_condiition){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select($field);
	$ci->db->from($table);
	if($whr_col !=''){
		$ci->db->where($whr_col,$whr_condiition);
	}
	$query = $ci->db->get();
	return $query->result();
}
function SelectQuery_th($field,$table,$whr_condition){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select($field);
	$ci->db->distinct('');
	$ci->db->from($table);
	if($whr_condition !=''){
		$ci->db->where($whr_condition);
	}
	$query = $ci->db->get();
	return $query->result();
}
function select_th($field,$table,$whr){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select($field);

	$ci->db->from($table);
	if($whr != ""){
	$ci->db->where($whr);
	}
	$query = $ci->db->get();
	return $query->result();
}
 function Pagination_query($table_name,$per_page,$page_name,$condition){
	$root = "http://".$_SERVER['HTTP_HOST'];
	$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$ci =& get_instance();
	$ci->load->database();
	$ci->load->library('session');
	$ci->load->helper('query');
	$ci->load->helper('form');
	$ci->load->helper('url');
	$ci->load->library("pagination");	
	$ci->load->model("admin/Admin_model");

	$config = array();
	$config["base_url"] = $root . $page_name;
	$config["total_rows"] = count(select_th('id',$table_name,$condition));
	$result["total_rows"] = count(select_th('id',$table_name,$condition));
	$config["per_page"] = $per_page;
	$result["per_page"] = $per_page;
	$config["page_query_string"] = TRUE;
	$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
    $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = "<li><span><b>";
	$config['cur_tag_close'] = "</b></span></li>";
	$config['first_link'] = '&laquo; First';
	$config['last_link'] = 'Last &raquo;';
	$config['use_page_numbers'] = true;
	$ci->pagination->initialize($config);
	$temp = strstr($_SERVER['REQUEST_URI'],'=');
	$temp = str_replace("=","",$temp);
	$temp= $temp - 1;
	$result["page"]=$temp;
	if($temp > 0)
	$page = $temp * $config["per_page"];
	else 
	$page= 0;
	$result['result']=$ci->Admin_model->show_pagination_filter($config["per_page"], $page,$table_name,$condition);
	$result["links"] = $ci->pagination->create_links();
	return $result;
}
 function MailSentNow($message,$subject,$to){	
	$ci =& get_instance();
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
	$ci->load->library('email');
	$ci->email->initialize($config);
	$ci->email->from('info@ayrgroup.in', 'AYRGROUP');
	$ci->email->to($to);
	// $ci->email->reply_to('neeraj.img@gmail.com');
	$ci->email->subject($subject);
	$ci->email->message($message);
	$ci->email->send();
}
 
function smsSent($mobile,$txtmsg){
 $txtmsg=rawurlencode($txtmsg);
// $url="http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=c9000d7b7c928b7bb6ef25f22e346f29&mobiles=".$mobile."&message=$txtmsg&sender=tipani&route=B";
    $url="http://sms.imgglobalinfotech.com/api/send_http.php?authkey=07c9a4feeec412e1522ed6b5656a7fef&mobiles=".$mobile."&message=$txtmsg&sender=OFCLIB&route=B";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($ch);
	curl_close($ch);	
}
 function shweta_insert_form($table_name,$data){
		$ci =& get_instance();	
	$ci->db->insert($table_name,$data);
}
function shweta_delete($table,$whr_col,$whr_data){
	$ci =& get_instance();
	$ci->db->where($whr_col,$whr_data);
	$ci->db->delete($table);
}
function shweta_popular($table,$data,$whr_col,$whr_data){
	$ci =& get_instance();
	$ci->db->where($whr_col,$whr_data);
	$ci->db->update($table,$data);
}
  function shweta_select_max_id($field,$table,$whr){
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select('MAX(user_id)');
	$ci->db->from($table);
	if($whr != ""){
	$ci->db->where($whr);
	}
	$query = $ci->db->get();
	$result=$query->result();
	foreach($result as $key=>$value){}
	$max="MAX(user_id)";
	return  $value->$max;
}


function showTreeMemberInfo($userId)
{
	
	$ci =& get_instance();
	$ci->load->database();
	$result=$ci->db->where('unique_id',$userId)->get('str_member')->row();

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
		'sponsor_id'=>$result->referrer_id." ( ".getNameIdByUniqueId($result->referrer_id)." )", 
		'left_id'=>($totalLeftId*100),
		'right_id'=>($totalRightId*100),
		'left_upgrade_total'=>$LefttotalActivateId,
		'right_upgrade_total'=>$RighttotalActivateId,
		'left_pv'=>$totalLeftId,
		'right_pv'=>$totalRightId,
		'doj'=>date("d/m/Y", strtotime($result->created_date)),
		'package_amount'=>$type,
	);
	return $data;
}

function getPackageAmtByUniqueId($unique_id)
{
	$packageAmount=0;	
	$result=selectQuery('package_amount','str_member','unique_id',$unique_id);
	if(!empty($result))
	{
		$packageAmount=$result['0']->package_amount;
	} 
	return $packageAmount;
}
function getUniqueIdById($id)
{
	$result=selectQuery('unique_id','str_member','member_id',$id);
	if(!empty($result))
	{
		return $result['0']->unique_id;
	}
	else
	{
		return "0";
	}	
}
function getNameIdByUniqueId($id)
{
	$result=selectQuery('name','str_member','unique_id',$id);
	if(!empty($result))
	{
		return ucfirst($result['0']->name);
	}
	else
	{
		return "N/A";
	}	
}

function getFirstNameIdByUniqueId($id)
{
	$result=selectQuery('name_type','str_member','unique_id',$id);
	if(!empty($result))
	{
		return ucfirst($result['0']->name_type);
	}
	else
	{
		return "N/A";
	}	
}
function getMobileIdByUniqueId($id)
{
	$result=selectQuery('mobile','str_member','unique_id',$id);
	if(!empty($result))
	{
		return ucfirst($result['0']->mobile);
	}
	else
	{
		return "0";
	}	
}

function getNameByMemberId($id)
{
	$result=selectQuery('name','str_member','member_id',$id);
	if(!empty($result))
	{
		return ucfirst($result['0']->name);
	}
	else
	{
		return "N/A";
	}	
}


function getPvByuniqueId($uniqueId,$date='')
{ 
	$cond="unique_id='".$uniqueId."'";
	if($date!='')
	{
		$cond.=" AND upgrade_date>='".$date."'";
	}
	$result=SelectQuery_th('pv_value','str_member',$cond); 
 
	$pvValue=0;
	if(!empty($result))
	{
		$pvValue=$result['0']->pv_value;
	} 
	return $pvValue;
}

function getIdByUniqueId($unique_id)
{
	$result=selectQuery('member_id','str_member','unique_id',$unique_id);
	if(!empty($result))
	{
		return $result['0']->member_id;
	}
	else
	{
		return "0";
	}	
}
/*====Get left and right member Id in registration Time=====*/

function descideUserSidebuildTree(array $elements, $parentId) {
    $branch = array();
    $count=0;$counta=0;
    foreach ($elements as $element) {
        if ($element['referrer_id'] == $parentId) {
            $children = descideUserSidebuildTree($elements, $element['unique_id']);
            $counta+=count($children);
            $data=array(
                'child'=>0,
            );
                if ($children && $counta>0) {
                    $count=$count;
                    $element['referrer_id'] = $children;
                    $data=array(
                    'child'=>1,
                );
            }   
                   
            if($data['child']==0){
                unset($element['referrer_id']);
            }
            $final_array=array_merge($data,$element);
            $branch[] = $final_array;
        }
   
    }
	return $branch;
   
}
 
function descideUserSide($parentId,$side){
    $parentId=strtolower($parentId);
    $cond="tree_side='".$side."'";
    $result=SelectQuery_th('member_id,unique_id,referrer_id,tree_side','str_member',$cond);
 
    $rows=array();
    foreach($result as $key=>$value){
        $data['member_id']=$value->member_id;
        $data['unique_id']=strtolower($value->unique_id);
        $data['referrer_id']=strtolower($value->referrer_id);
        $data['tree_side']=$value->tree_side;  
        $rows[]=$data;
    }
	
 
	
    $tree = descideUserSidebuildTree($rows,$parentId);

    $finarray = array_flatten($tree);

    $farray=array();
    if(!empty($finarray)){
        $i=0;$main=0;
        foreach($finarray as $fg){
            if($i%4==0){
                $main=$main+1;
            }
            $farray[$main][]=$fg;
            $i++;
        }
    }
else
{
	return "0";
	die;
}	
 
    if(!empty($farray))
	{ 
		end($farray);         // move the internal pointer to the end of the array
		$key = key($farray);
		return $farray[$key]['0'];
		die;
	}
	else
	{ 
		return "0";
	}
}
    function array_flatten($array) {
       if (!is_array($array)) {
        return FALSE;
      }
      $result = array();
      foreach ($array as $key => $value){
          if (is_array($value)) {
              $arrayList=array_flatten($value);
              foreach ($arrayList as $listItem) {
                $result[] = $listItem;
              }
            }
           else {
            $result[$key] = $value;
           }
      }
      return $result;
    } 
 
 
 /*===get unique id for define side for every user in registration time===*/
 
 function createuserSide($parentId,$side)
	{ 
		$parentId=strtolower($parentId);
		$result=SelectQuery_th('id,unique_id,left,right','str_binarytree',''); 
		$rows=array();
		foreach($result as $key=>$value){
			$data['id']=$value->id;
			$data['unique_id']=strtolower($value->unique_id);
			$data['left']=strtolower($value->left);
			$data['right']=strtolower($value->right); 
			$rows[]=$data;
		}
		$tree = createTreeUser($rows,$parentId,$side); 
		
		$florr=arrayDecode($tree);
	  
		if(!empty($florr))
		{
			end($florr);         // move the internal pointer to the end of the array
			$key = key($florr);
			return $florr[$key]['0'];
		}
		else
		{
			return "0";
		}
	}
	
	function createTreeUser(array $elements, $parentId,$side) {		 
		$branch=array();		
		foreach($elements as $element){
			if ($element['unique_id'] == $parentId)
			{ 			   
						$children = createTreeUser($elements, $element[$side],$side);						 
						if ($children) { 
							$element[] = $children;
						} 						
				 $branch[] = $element;	 			
			}  		
		}
		return $branch;	 
	}
	
	function arrayDecode($tree)
	{
		$finarray = array_flatten($tree);		 
		$farray=array();
		if(!empty($finarray)){
			$i=0;$main=0;
			foreach($finarray as $fg){
				if($i%4==0){
					$main=$main+1;
				}
				$farray[$main][]=$fg;
				$i++;			   
			}
		}
		return $farray;
	}
	
 function tree_data($uniqueId)
 {
	 $result=SelectQuery('*','str_binarytree','unique_id',$uniqueId);
	 return $result;
 }


/* start method for count leftpv and right pv for create any income*/ 
	function createTreeForUser(array $elements, $parentId) {
		$branch = array(); 
		foreach ($elements as $element) {
			if ($element['referrer_id'] == $parentId) {
				$children = createTreeForUser($elements, $element['unique_id']); 
				 
				if ($children) { 
						$element['child'] = $children;
				 }	
					  
				$branch[] = $element;
			}
		
		}
	 
		return $branch;
	}
	
function createTreestructureForUserWise($parentId,$side){
	$parentId=strtolower($parentId);
	$result=SelectQuery_th('id,unique_id,left,right','str_binarytree',''); 
	$rows=array();
	foreach($result as $key=>$value){
		$data['id']=$value->id;
		$data['unique_id']=strtolower($value->unique_id);
		$data['left']=strtolower($value->left);
		$data['right']=strtolower($value->right); 
		$rows[]=$data;
	}
	$tree = createTreeUser($rows,$parentId,$side); 	
	$florr=arrayDecode($tree);
	return $florr; 
}


	function getUserleftRightId($parentId,$side)
	{
			$parentId=strtolower($parentId);
			$result=SelectQuery_th('id,unique_id,left,right','str_binarytree',''); 
			$rows=array();
			foreach($result as $key=>$value)
			{
				$data['id']=$value->id;
				$data['unique_id']=strtolower($value->unique_id);
				$data['left']=strtolower($value->left);
				$data['right']=strtolower($value->right); 
				$rows[]=$data;
			}
			$tree = createTreeUser($rows,$parentId,$side); 	
			$florr=arrayDecode($tree);
			 unset($florr[1]);
			 $florr=array_values($florr);
			// unset
			return $florr; 
	}
	
/* end method for count leftpv and right pv for create any income*/ 

function getBothleftAndrightChild($parentId,$side)
{ 
	$sideUniqueId=''; 
	foreach(SelectQuery($side,'str_binarytree','unique_id',$parentId) as $raa) $sideUniqueId=$raa->$side;
	$farray=array();
	if($sideUniqueId!='')
	{
			$ci =& get_instance();
			$ci->load->database();
		 $treeResult=$ci->db->get('str_binarytree')->result();
		 foreach($treeResult as $key=>$value)
		 { 
				$data['unique_id']=strtolower($value->unique_id);
				$data['left']=strtolower($value->left); 
				$data['right']=strtolower($value->right); 
				$rows[]=$data;
			}	 
		 $tree = getBothleftAndrightChildRec($rows,$sideUniqueId);
		 $finarray = array_flatten($tree);
		
		 /*==Convert tree in particular foramt==*/
		 
		  if(!empty($finarray)){
			$i=0;$main=0;
			foreach($finarray as $fg){
				if($i%3==0){
					$main=$main+1;
				}
				$farray[$main][]=$fg;
				$i++;
			}
		} 
	}
	
		return $farray;
}

function getBothleftAndrightChildRec(array $elements, $parentId) {
	$parentId=strtolower($parentId);
    $branch = array();
    $count=0;$counta=0;
    foreach ($elements as $element) {
        if ($element['unique_id'] == $parentId){  
			if($element['left']!='')
			{
				 $children = getBothleftAndrightChildRec($elements, $element['left']);
				  if ($children) { 
                    $element['referrer_id'] = $children;
                  
				}    
			}
			if($element['right']!='')
			{
				 $children1 = getBothleftAndrightChildRec($elements, $element['right']);
				  if ($children1) { 
                    $element['referrer_id1'] = $children1;
                  
				}    
			}    
            $branch[] = $element;
        }
   
    }
	return $branch;  
}

	function getTotalActiveId($userId,$side)
	{
		$commDate=startcommDate();
		$totalUpgradeId=0; 
		$leftIdArray=getBothleftAndrightChild($userId,$side);
		if(!empty($leftIdArray))
		{
			
			foreach($leftIdArray as $leftIdArrayKey)
			{	
				$result=gettotalActFromDate($leftIdArrayKey[0],$commDate);
				if($result>0)
				{
					$amount="0";
					$amount=getPackageAmtByUniqueId($leftIdArrayKey[0]);
					if($amount>0)
					{
						$totalUpgradeId++;
					}
				}					
			 }
		}
		return $totalUpgradeId;
	}
	
	/*==start pin work==*/
	
	function checkPinAmount($pinId)
	{
		$pinAmount=0;
		foreach(SelectQuery('amount','str_pinlist','pin_no',$pinId) as $raa) $pinAmount=$raa->amount;
		return $pinAmount;
	}
	function checkPinBusinessVolume($pinId)
	{
		$business_volume=0;
		foreach(SelectQuery('business_volume','str_pinlist','pin_no',$pinId) as $raa) $business_volume=$raa->business_volume;
		return $business_volume;
	}
	
	function checkPinPvValue($pinId)
	{
		$pv_value=0;
		foreach(SelectQuery('pv_value','str_pinlist','pin_no',$pinId) as $raa) $pv_value=$raa->pv_value;
		return $pv_value;
	}
	
	function pinStatus($status)
	{
		if($status=='1')
		{
			return "Active";
		}
		else
		{
			return "Deactive";
		}
	}
	function pinusedStatus($status)
	{
		if($status=='1')
		{
			return "Close";
		}
		else
		{
			return "Open";
		}
	}
	
	function pinAmountIdByPinNo($pinNo)
	{
		$pin_amountid=0;
		foreach(SelectQuery('pin_amountid','str_pinlist','pin_no',$pinNo) as $raa) $pin_amountid=$raa->pin_amountid;
		return $pin_amountid;
	}
	/*==End pin work==*/
 
 
 	function countTotalLeftRightIdBYSide($uniqueId,$side)
	{
		$commDate=startcommDate();
		$leftId=getBothleftAndrightChild($uniqueId,$side);
		 $totalLeftPv=0;
		 if(!empty($leftId))
		 {
			 foreach($leftId as $leftChild)
			 {
				 $totalLeftPv=gettotalActFromDate($leftChild[0],$commDate); 
			 }
		 }
		 return $totalLeftPv;
	}
	
	function countTotalLeftRightPvBYSide($uniqueId,$side)
	{
		$commDate=startcommDate(); 
		$leftId=getBothleftAndrightChild($uniqueId,$side);
	 
		 $totalLeftPv=0;
		 if(!empty($leftId))
		 {
			 foreach($leftId as $leftChild)
			 {
				 $totalLeftPv+=getPvByuniqueId($leftChild[0],$commDate);  
			 }
		 }
		 return $totalLeftPv;
	}
	
	function gettotalActFromDate($uniqueId,$date='')
	{
		$cond="unique_id='".$uniqueId."'";
		if($date!='')
		{
			$cond.=" AND upgrade_date>='".$date."'";
		}
		$result=SelectQuery_th('member_id','str_member',$cond); 
		 
		return count($result);
	}
	
	function totalBinaryIncome($userId)
	{
		
		$ci =& get_instance();
		$ci->load->database();
	
		$total='0.00';
		
		$result=$ci->db->select('SUM(amount) as total')->where(array('particular_id'=>'1','user_id'=>$userId))->get('str_wallet')->row();
		 
		if(!empty($result) && $result->total!='')
		{
			$total=$result->total;
		}
		
		return $total;
	}
	
	function totalUserTds($userId)
	{
		
		$ci =& get_instance();
		$ci->load->database();
	
		$total='0.00';
		
		$result=$ci->db->select('SUM(tds_amount) as total')->where(array('user_id'=>$userId))->get('str_wallet')->row();
		 
		if(!empty($result) && $result->total!='')
		{
			$total=$result->total;
		}
		
		return $total;
	}
	
	function totalUserAdminCharge($userId)
	{
		
		$ci =& get_instance();
		$ci->load->database();
	
		$total='0.00';
		
		$result=$ci->db->select('SUM(admin_amount) as total')->where(array('user_id'=>$userId))->get('str_wallet')->row();
		 
		if(!empty($result) && $result->total!='')
		{
			$total=$result->total;
		}
		
		return $total;
	}
	
	function getProductName($productId)
	{
		
		$ci =& get_instance();
		$ci->load->database();	
		$name='N/A';	
		
		$result=$ci->db->select('name')->where(array('id'=>$productId))->get('products')->row();
		 
		if(!empty($result) && $result->name!='')
		{
			$name=ucfirst($result->name);
		}
		
		return $name;
	}
	
	function createOrderNo($id)
	{
	 
		$numlength = strlen((string)$id);		
		$idno=$numlength;
		if($idno <=1){
			$userUnique_id= "Ord-000000".$id;
		}elseif($idno <=2){
			$userUnique_id= "Ord-00000".$id;
		}elseif($idno <=3){
			$userUnique_id= "Ord-0000".$id;
		}elseif($idno <=4){
			$userUnique_id= "Ord-000".$id;
		}elseif($idno <=5){
			$userUnique_id= "Ord-00".$id;
		}elseif($idno <=6){
			$userUnique_id= "Ord-0".$id;
		}elseif($idno <=7){
			$userUnique_id= "Ord-".$id;
		}else{
			$userUnique_id= $id;
		}	
		
		return $userUnique_id;
	}
?>