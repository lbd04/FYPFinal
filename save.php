
<?php
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$newcourses = json_decode($_POST['coursestoadd']);
include_once("php_includes/db_conx.php");
$getc = "Delete From enrolls WHERE username = \"" .$data . "\" ;" ;

if ($db_conx->query($getc) == true){
	foreach ( $newcourses as $course) {
		if ($course->Grade > 60 ) {
		$getc = "Insert into enrolls values ( \"" .$data . "\",\"" . $course->Course . "\", \"1 \",\" "  . $course->Grade .  "\") ;" ;
		$db_conx->query($getc) ;
		}
		else {
		$getc = "Insert into enrolls values ( \"" .$data . "\",\"" . $course->Course . "\", \"0 \",\" "  . $course->Grade .  "\") ;" ;
		$db_conx->query($getc) ;	
		}
	}
	echo ("Done") ;
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
