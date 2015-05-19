<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$sem = $_POST['sem'] ;


$getc = 'SELECT major From student WHERE username = "' .$data . '";' ;
$true = $db_conx->query($getc) ;
$outp ="" ;
foreach($true as $rs) { 
	 $outp = $rs['major'];
}
$getcc = 'SELECT DISTINCT courseID
FROM majorrequirement
NATURAL JOIN requires
WHERE preRequisite
IN (
SELECT DISTINCT preRequisite
FROM requires
WHERE preRequisite LIKE  "CMPS %"
AND preRequisite
IN (
SELECT courseID
FROM enrolls
WHERE username =  "'.$data.'" and completed = "1"
)
)' ;                                   
$true1 = $db_conx->query($getcc) ;
$outp1 = "" ;
foreach($true1 as $rs) { 
     if ( (intval($rs['semesterOffered']) & intval($sem)) == intval($sem)) {
	 $outp1 = $outp1 . '{"Course" :"' . $rs['courseID']   . '" , "Credits" :"'.$rs['creditHours'] .'" , "semester" : "'.$rs['semesterOffered'].'"},';
	 }
}
   echo   '{"courses" :[' . substr($outp1 ,0, -1) . '] }' ;
?>
<?php

?>