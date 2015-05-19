
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$newcourses = json_decode($_POST['coursestoadd']);
$attr = $_POST['attr'];
$getc = "" ;

	foreach ( $newcourses as $course) {
		$getc = "Delete FROM enrolls WHERE username = \"" .$data . "\" AND courseID= \"" . $newcourses->Course . "\" ;" ;
		$db_conx->query($getc) ;
		
		if ( $attr == "Natural Science") {
			$getc = 'update coursescount set naturale = naturale + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}else if ( $attr == "English Communication Skills") {
			$getc = 'update coursescount set english = english + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}else if ( $attr == "cvsp1") {
			$getc = 'update coursescount set cvsp1 = cvsp1 + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}else if ( $attr == "cvsp2") {
			$getc = 'update coursescount set cvsp2 = cvsp2 + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}
		else if ( $attr == "Humanities II" || $attr == "Humanities I") {
			$getc = 'update coursescount set humanity1 = humanity1 + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		} else if ( $attr == "Mathstat") {
			$getc = 'update coursescount set requiredmath = requiredmath + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		} else if ( $attr == "rscience") {
			$getc = 'update coursescount set requiredscience = requiredscience + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}
		else if ( $attr == "Quantitative Thought") {
			$getc = 'update coursescount set quantative = quantative + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}
		else if ( $attr == "Arabic Communication Skills") {
			$getc = 'update coursescount set arabic = arabic + 1 where username = "'.$data.'"  ;' ;
		    $db_conx->query($getc) ;
		}
		break ;
	}

	
	exit () ;

?>


<!--
INSERT INTO `aub`.`enrolls` (`username`, `courseID`, `completed`, `grade`) VALUES ('lbd04', 'CMPS 200', '1', '90'), ('lbd04', 'CMPS 205', '1', '60');
-->
