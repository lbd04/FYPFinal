
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = "SELECT social1 From coursescount WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp ="" ;
$outp1 = " " ;
foreach($true as $rs) { 
	 $outp =  intval($rs['social1']) ;
	 break ;
}

if ($outp > 0) {
	$getc = 'SELECT courseID From ge_verify WHERE  courseID not in (SELECT courseID FROM enrolls where  username= "' .$data . '") and courseID not in (SELECT courseID FROM temp where  username= "' .$data . '") and attribute = "Social Science I" ;' ;
    $true = $db_conx->query($getc) ;

     foreach($true as $rs) { 
	    $outp1 = $outp1 . '{"Course" :"' . $rs['courseID']   . '" , "Credits" :"3" , "Attribute" : "Social Science I" },';
     }


$getc = 'SELECT social2 From coursescount WHERE username = "' .$data . '";' ;
$true = $db_conx->query($getc) ;
$outp ="" ;
foreach($true as $rs) { 
	 $outp =  intval($rs['social2']) ;
	 break ;
}

if ($outp > 0) {
	$getc = 'SELECT courseID From ge_verify WHERE  courseID not in (SELECT courseID FROM enrolls where  username= "' .$data . '") and courseID not in (SELECT courseID FROM temp where  username= "' .$data . '") and attribute = "Social Science II" ;' ;
    $true = $db_conx->query($getc) ;

     foreach($true as $rs) { 
	    $outp1 = $outp1 . '{"Course" :"' . $rs['courseID']   . '" , "Credits" :"3" , "Attribute" : "Social Science II" },';
     }
}
}

echo   '{"courses" :[' . substr($outp1 ,0, -1) . '] }' ;
?>
