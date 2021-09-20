<?php
class Form_model extends CI_Model{
public function __construct() {
	parent::__construct(); 
		
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
		 
		if($this->session->userdata('store100mlmadmin')!='')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getTotalUserPurchase($userId)
	{
		$result=$this->db->select('SUM(package_amount) as totalPurchase')->where('user_id',$userId)->get('str_turnover_detail')->row_array();
		
		return $result['totalPurchase'];
		
		die;
	}
}
?>