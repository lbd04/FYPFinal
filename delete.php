
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$newcourses = json_decode($_POST['coursestoadd']);

$getc = "" ;

	foreach ( $newcourses as $course) {
		$getc = "Delete FROM enrolls WHERE username = \"" .$data . "\" AND courseID= \"" . $newcourses->Course . "\" ;" ;
	}
	if ($db_conx->query($getc) == true){
	exit(); 
}
else {
	echo ("Error") ;
	exit () ;
}
?>


<!--
INSERT INTO `aub`.`enrolls` (`username`, `courseID`, `completed`, `grade`) VALUES ('lbd04', 'CMPS 200', '1', '90'), ('lbd04', 'CMPS 205', '1', '60');
-->
