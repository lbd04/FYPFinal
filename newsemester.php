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
	echo $outp ;
	exit(); 
?>