<?php
class Admin_model extends CI_Model{
public function __construct() {
parent::__construct();
$this->load->database();
$this->load->library('session');
}
public function getLanguage(){
	date_default_timezone_set('Asia/Kolkata'); 
	if($this->session->userdata('language')!=""){
			$lang=$this->session->userdata('language');
		}else{
			$lang="english";
		}
	$this->lang->load('content',$lang);
		return $lang;
}
	public function get_result($data,$tablename){
		$this->db->select('*');
		$this->db->from($tablename);
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();	
	}
	public function get_book_quantity($book_id,$tablename){
		$data1=array(
		'id'=>$book_id,
		'status'=>1,
		);
		$this->db->select('quantity');
		$this->db->from($tablename);
		$this->db->where($data1);
		$query = $this->db->get();
		$result= $query->result();	
		$book_quantity=0;
		if(!empty($result)){
			foreach($result as $key=>$value){
				$book_quantity=$value->quantity;
			}
		}
		return $book_quantity;
	}
	public function get_Right_Ans($user_ans,$question_id){
		$data1=array(
		'question_id'=>$question_id,
		);
		$this->db->select('right_ans');
		$this->db->from('ans_question_exam');
		$this->db->where($data1);
		$query = $this->db->get();
		$result= $query->result();	
		$right_ans='';
		if(!empty($result)){
			foreach($result as $key=>$value){
				$right_ans.=$value->right_ans.',';
			}
		}
		$right_ans=rtrim($right_ans,' , ');
		return $right_ans;
	}
	public function get_ResultQuestion($user_ans,$question_id){
		$data1=array(
		'question_id'=>$question_id,
		);
		$this->db->select('right_ans');
		$this->db->from('ans_question_exam');
		$this->db->where($data1);
		$query = $this->db->get();
		$result= $query->result();	
		$res='wrong';
		if(!empty($result)){
			foreach($result as $key=>$value){
				if($value->right_ans ==$user_ans){
					$res='right';
				}
				// $right_ans.=$value->right_ans.',';
			}
		}
		// $right_ans=rtrim($right_ans,' , ');
		return $res;
	}
	public function get_resultCountOfQuestion($dataSubject,$tablename){
 
		$this->db->select('no_of_ques');
		$this->db->from($tablename);
		$this->db->where($dataSubject);
		$query = $this->db->get();
		$result= $query->result();	
		// echo "<pre>";
		// print_r($result);
		// die;
		$no_of_ques=0;
		if(!empty($result)){
			foreach($result as $key=>$value){
				$no_of_ques+=$value->no_of_ques;
			}
		}
			return $no_of_ques;
	}
	public function get_Issue_Book_result($Issue_Book_resultCond,$tablename){
 
		$this->db->select('book_quantity');
		$this->db->from($tablename);
		$this->db->where($Issue_Book_resultCond);
		$query = $this->db->get();
		$result= $query->result();	
		// echo "<pre>";
		// print_r($result);
		// die;
		$book_quantity=0;
		if(!empty($result)){
			foreach($result as $key=>$value){
				$book_quantity+=$value->book_quantity;
			}
		}
		return $book_quantity;
	}
 
	public function insert_data($data,$tableName){
		$this->db->insert($tableName,$data);	
	}
	public function delete_data($data,$tableName){
		$this->db->where($data);
		$this->db->delete($tableName);		
	}
		public function get_resultsortBy($data,$tablename,$sortname,$sory_by){
		$this->db->select('*');
		$this->db->from($tablename);
		if(!empty($data)){
			$this->db->where($data);
		}
		if($sortname !=''){
			$this->db->order_by($sortname,$sory_by);
		}
		$query = $this->db->get();
		return $query->result();	
	}
 
	function update_data($table,$data,$whr_col,$whr_data){
	$this->db->where($whr_col,$whr_data);
	$this->db->update($table,$data);
}
	function update_datawhre($table,$data,$whr_col){
	$this->db->where($whr_col);
	$this->db->update($table,$data);
}
	public function show_pagination_filter($limit,$start,$table_name,$condition){
	$data=array();
        $query = order_by_limit_new('*',$table_name,$condition,$limit, $start,'id','DESC');
		if ($query > 0) {
            foreach ($query as $row) {
                $data[] = $row;
            } 
            return $data;
        }
        return false;
}
	public function show_pagination_filterBylevydate($limit,$start,$table_name,$condition){
	$data=array();
        $query = order_by_limit_new('*',$table_name,$condition,$limit, $start,'levy_due_date','ASC');
		if ($query > 0) {
            foreach ($query as $row) {
                $data[] = $row;
            } 
            return $data;
        }
        return false;
}
}
?>