<?php

class Demo extends CI_Controller {

function __construct() {
parent::__construct();
$this->load->helper('form');
$this->load->helper('query');
$this->load->model('Form_model');
$this->load->library('session'); 
$this->load->dbutil();
}
	function index(){ 
		echo date("D");
		die;
    	  $leftChild=getBothleftAndrightChild('rekha','left');
    	  $rightChild=getBothleftAndrightChild('rekha','right');
    	  
    	  $$childArray=array();
    	  $fianlChild=array_merge($leftChild,$rightChild);
    	  
    	   if(!empty($fianlChild))
    	   {
    	       foreach($fianlChild as $fianlChildValue)
    	        {
    	            $childArray[]=$fianlChildValue[0];
    	        }
    	   }
    	   
    	   echo "<pre>";
    	   print_r(array_unique($childArray));
    	   die;
 	}
	function EXPORT_TABLES($tables=false, $backup_name=false ){
		$host='localhost';
		$uname='wwwdemoi_prl';
		$pass='kKz=}!KmfwpE';
		$database='wwwdemoi_prl';

$connection=mysql_connect($host,$uname,$pass); 

echo mysql_error();

//or die("Database Connection Failed");
$selectdb=mysql_select_db($database) or 
die("Database could not be selected"); 
$result=mysql_select_db($database)
or die("database cannot be selected <br>");

// Fetch Record from Database

$output = "";
$table = ""; // Enter Your Table Name 
$sql = mysql_query("select * from $table");
$columns_total = mysql_num_fields($sql);

// Get The Field Name

for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
$output .="\n";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) {
for ($i = 0; $i < $columns_total; $i++) {
$output .='"'.$row["$i"].'",';
}
$output .="\n";
}

// Download the file

$filename = "myFile.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
}
function hitesh(){
	
	
		$host='localhost';
		$uname='wwwdemoi_prl';
		$pass='kKz=}!KmfwpE';
		$database='wwwdemoi_prl';
		
$db_record = 'cpf';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "wwwdemoi_prl";
$password = "kKz=}!KmfwpE";
$database = "wwwdemoi_prl";
// Database connecten voor alle services
$con = mysqli_connect($hostname,$user,$password,$database);
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());
// create empty variable to be filled with export data
$csv_export = '';
// query to get data from database
$query = mysql_query("SELECT * FROM ".$db_record." ".$where);
$field = mysql_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysql_field_name($query,$i).';';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';
  }	
  $csv_export.= '
';	
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}
function ExportCSV()

{		date_default_timezone_set("Asia/Kolkata");
		$curTime=date("Y-m-d H:i:s");
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
		$data ='   ';
        $newline = "\r\n";
		$tab_name = "SHOW TABLES";
        $table_name_array = $this->db->query($tab_name);
		$allResult=$this->db->list_tables(); 		 
		foreach($allResult as $table_name_array){		
        $filename = "Hrm-( $curTime ).csv";		
        $query = "SELECT * FROM ".$table_name_array."";
        $result = $this->db->query($query);

        $data .= $this->dbutil->csv_from_result($result, $delimiter, $newline);		
		}
		force_download($filename, $data);

}
	function convert_time(){
		// date_default_timezone_set("Asia/Kolkata");
		 echo date("Y-m-d", strtotime("fri Sep 29 2017 02:00:00 GMT+000"));	
		// echo date("Y-m-d", strtotime("Sat Sep 24 2016"));	
		// $date = new DateTime('Sep 29 2017 00:00:00', new DateTimeZone('GMT'));
			// $date->setTimezone(new DateTimeZone('IST'));
			// echo $date->format('Y-m-d H:i:s');
	}
	function dateDemo(){
		date_default_timezone_set("Asia/Kolkata");
			$to_time="2017-10-08 08:00:00";
			 $from_time="2017-10-08 09:30:00";
			$from_time=date('Y-m-d H:i:s',strtotime("-90 minutes", strtotime($from_time)));
			$start_date = new DateTime($to_time);
			$since_start = $start_date->diff(new DateTime($from_time));
			echo $since_start->h.' hours<br>';
			echo $since_start->i.' minute<br>';
	}
	
	function directIncome()
	{
		$result=$this->db->where('reward_amount <','1000')->get('str_directincome')->result_array();
		
		foreach($result as $value)
		{
			$member=$this->db->where('member_id',$value['user_id'])->get('str_member')->row_array();
			
			$data=array(
				'user_name'=>$member['name'],
				'pair'=>($value['total_user']/2),
				'amount'=>$value['reward_amount'],
				'date'=>$value['created_date'],
			);
			
			$this->db->insert('test1',$data);
		}
	}
	
	function updateBankDetail()
	{
		$result=$this->db->where('particular_id','12')->get('str_wallet')->result_array();
		
		foreach($result as $value)
		{
			$memberDetail=$this->db->where('member_id',$value['user_id'])->get('str_member')->row_array();
			
			$data=array(
				'wallet_id'=>$value['wallet_id'],
				'user_id'=>$value['user_id'],
				'bank_name'=>$memberDetail['bank_name'],
				'account_no'=>$memberDetail['account_no'],
				'ifsc_code'=>$memberDetail['ifsc_code'],
				'branch_name'=>$memberDetail['branch'],
			);
			
			$this->db->insert('withdrawl_bankdetail',$data); 
		}
	}
}