<?php
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$newcourses = json_decode($_POST['newsemester']);
include_once("php_includes/db_conx.php");
$outp = "" ;
	foreach ( $newcourses as $course) {
		$getc = 'Insert into enrolls ( username , courseID , completed ) values ( "' .$data . '","' . $course->Course . '" , "0") ;' ;
		$db_conx->query($getc) ;
		$outp = $outp . " " . $course->Course ;
	}
$getc = "SELECT courseID ,grade From enrolls WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp ="" ;
$num = 1 ;
foreach($true as $rs) { 
    // $outp [$num] = array ( "Course" => $rs['courseID'] , "Grade" => $rs['grade'] ) ; 
	 //$num = $num + 1;
	 $outp = $outp . '{"Course" :"' . $rs['courseID']   . '","Grade": "' . $rs['grade'] . '"},';
}


echo  '{"courses" : [' . substr($outp ,0, -1) . ']}' ;
?>