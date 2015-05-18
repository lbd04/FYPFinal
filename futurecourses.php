<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = 'SELECT major From student WHERE username = "' .$data . '";' ;
$true = $db_conx->query($getc) ;
$outp ="" ;
foreach($true as $rs) { 
	 $outp = $rs['major'];
}
$getcc = 'SELECT courseID, creditHours , semesterOffered From majorrequirement natural join course WHERE courseID not in (SELECT courseID FROM enrolls where courseID LIKE "'. $outp.'%" and username= "' .$data . '") and major="' . $outp .'" ORDER BY courseID;' ;                                   
$true1 = $db_conx->query($getcc) ;
$outp1 = "" ;
foreach($true1 as $rs) { 
	 $outp1 = $outp1 . '{"Course" :"' . $rs['courseID']   . '" , "Credits" :"'.$rs['creditHours'] .'" , "semester" : "'.$rs['semesterOffered'].'" , "Attribute" : "major"},';
}
   echo   '{"courses" :[' . substr($outp1 ,0, -1) . '] }' ;
?>
<?php
/*
(
SELECT course.courseID, creditHours, semesterOffered
FROM majorrequirement
NATURAL JOIN course
NATURAL JOIN requires
WHERE courseID NOT 
IN (
SELECT courseID
FROM enrolls
WHERE courseID LIKE  "CMPS %"
AND username =  "lbd04"
)
AND preRequisite
IN (
SELECT courseID
FROM enrolls
WHERE courseID LIKE  "CMPS %"
AND username =  "lbd04"
)
AND major =  "CMPS"
)
UNION 
(
SELECT course.courseID, creditHours, semesterOffered
FROM majorrequirement
NATURAL JOIN course
NATURAL JOIN requires
WHERE courseID NOT 
IN (
SELECT courseID
FROM enrolls
WHERE courseID LIKE  "CMPS %"
AND username =  "lbd04"
)
AND 
AND major =  "CMPS"
)
*/
?>