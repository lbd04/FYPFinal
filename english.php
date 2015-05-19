
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = "SELECT english From coursescount WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp ="" ;
$num = 1 ;
foreach($true as $rs) { 
	 $outp =  intval($rs['english']) ;
	 break ;
}

if ($outp == 1) {
	echo  '{"courses" : [ {"Course" :"ENGL 204","Credits": "3" , "Attribute" : "english"} ] }' ;
}
else if ($outp == 2) {
	echo  '{"courses" : [ {"Course" :"ENGL 203","Credits": "3", "Attribute" : "english"} ] }' ;
} else if ($outp == 3) {
	echo  '{"courses" : [ {"Course" :"ENGL 102","Credits": "3", "Attribute" : "english"} ] }' ;
}
else  {
	echo '{"courses" : []}' ;
}
?>
