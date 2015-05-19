<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = "SELECT major From student WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp ="" ;
$outp1 ="" ;
$num = 1 ;
foreach($true as $rs) { 
	 $outp =  $rs['major'] ;
	 break ;
}

if ($outp == "CMPS" ){
	$getc = 'SELECT courseID , Attribute , creditHours From others natural join ge_verify natural join course WHERE  courseID not in (SELECT courseID FROM enrolls where  username= "' .$data . '") and courseID not in (SELECT courseID FROM temp where  username= "' .$data . '")  ;' ;
    $true = $db_conx->query($getc) ;

     foreach($true as $rs) { 
	    $outp1 = $outp1 . '{"Course" :"' . $rs['courseID']   . '" , "Credits" :"'. $rs['creditHours'].'" , "Attribute" : "'.$rs['Attribute'].'" },';
     }
}
else if ($outp == "") {
	echo  '{"courses" : [ {"Course" :"ENGL 203","Credits": "3", "Attribute" : "english"} ] }' ;
} 
else  {
	echo '{"courses" : []}' ;
}

echo '{"courses" :[' . substr($outp1 ,0, -1) . '] }' ;
?>