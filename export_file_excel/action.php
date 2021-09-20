<?php
include "header.php";

if ( isset($_POST["submit"]) ) {
    if ( isset($_FILES["file"])) {
        //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
	?>
<img src="sorry.jpg" style="    margin: 21px 265px;float: none;width: 40%;">
<br>
<h3 style="text-align:center;">File is not valid format !...</h3> 
<h3 style="text-align:center;">Please try again...</h3> 
<center>
<a href="home.php" class="btn btn-default buttoupdate" style="">Back</a> 
</center>
	<?php 
        }
        else {
            $storagename = "myfile.xls";
            move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
            $uploadedStatus = 1;

    define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "wwwtract_user"); // set database user
define ("DB_PASS","4@#u9L78b8v_"); // set database password
define ("DB_NAME","wwwtract_db"); // set database name

    // define ("DB_HOST", "localhost"); // set database host
// define ("DB_USER", "root"); // set database user
// define ("DB_PASS",""); // set database password
// define ("DB_NAME","wwwtract_db"); // set database name


            $link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
            $db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

            $databasetable = "dealers";

            /************************ YOUR DATABASE CONNECTION END HERE  ****************************/


            set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
            include 'PHPExcel/IOFactory.php';

            // This is the file path to be uploaded.
            $inputFileName = 'myfile.xls';

            try {
                $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

for($i=2;$i<=$arrayCount;$i++){
$state = trim($allDataInSheet[$i]["A"]);
$city = trim($allDataInSheet[$i]["B"]);
$name_de = trim($allDataInSheet[$i]["C"]);
$authorize = trim($allDataInSheet[$i]["D"]);
$address = trim($allDataInSheet[$i]["E"]);
$pin = trim($allDataInSheet[$i]["F"]);
$contact = trim($allDataInSheet[$i]["G"]);


$insertTable= mysql_query("insert into dealers (state, city, name_de, authorize, address, pin, contact) values('".$state."', '".$city."', '".$name_de."', '".$authorize."', '".$address."', '".$pin."', '".$contact."');");


$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"></div>';

}
      
            unlink('myfile.xls');
			echo "
<div>
<h3 style='text-align:center;'>Record has been added</h3> 

<center>
	<center>
</div>

";
        }
    } else {
        echo "No file selected <br/>";
    }
}
?>