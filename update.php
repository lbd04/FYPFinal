
<?php
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$newcourses = json_decode($_POST['coursestoadd']);
$complete = $_POST ['complete'] ;
//$db = mysqli_connect("localhost", "root", "", "aub");
include_once("php_includes/db_conx.php");
$getc = "" ;
$getc1 = "" ;
$getc = 'select major from student where username="'.$data .'";' ;
$true = $db_conx->query($getc)  ;
$major = "" ;
foreach ($true as $rs) {
	$major = $rs['major'] ;
	break ;
}

	foreach ( $newcourses as $course) {
		$getc = 'Update enrolls set grade= "' . $newcourses->Grade . '",completed= ' . $complete . ' WHERE username = "' .$data . '" AND courseID= "' . $newcourses->Course . '";' ;
		$db_conx->query($getc)  ;
		break ;
	}
	if ($complete == 1) {
	if (strpos($newcourses->Course,$major) !== false) {
		$getc = 'select major from majorrequirement where courseID = " '.$newcourses->Course.'"' ;
		$true = $db_conx->query($getc)  ;
		$attr = "" ;
		foreach ($true as $rs) {
	      $attr = $rs['major'] ;
		  break ;
        }
		echo $attr

    }
}
	
	
//echo "" ; 
exit () ;
?>


<!--
INSERT INTO `aub`.`enrolls` (`username`, `courseID`, `completed`, `grade`) VALUES ('lbd04', 'CMPS 200', '1', '90'), ('lbd04', 'CMPS 205', '1', '60');
-->
