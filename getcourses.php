
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = "SELECT major From student WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp1 ="" ;
foreach($true as $rs) { 
	 $outp1 =  $rs['major'] ;
	 break ;
}

$getc = "SELECT courseID ,grade From enrolls WHERE username = \"" .$data . "\" ;" ;
$true = $db_conx->query($getc) ;
$outp ="" ;
$num = 1 ;
foreach($true as $rs) {
      if (strpos($rs['courseID'] , $outp1) !== false) {
		  $getc = 'SELECT courseID ,grade, attribute From enrolls natural join majorrequirement WHERE username = "' .$data . '" and courseID = "'.$rs['courseID'].'" ;' ;
          $true1 = $db_conx->query($getc) ;
		  foreach($true1 as $rs1) {
		  $outp = $outp . '{"Course" :"' . $rs1['courseID']   . '","Grade": "' . $rs1['grade'] . '","Attribute": "' . $rs1['attribute'] . '"},';
		  break ;
		  }
	  }
	  else {
		  $getc = 'SELECT courseID ,grade, attribute From enrolls natural join ge_verify WHERE username = "' .$data . '" and courseID = "'.$rs['courseID'].'" ;' ;
          $true2 = $db_conx->query($getc) ;
		  foreach($true2 as $rs2) {
	      $outp = $outp . '{"Course" :"' . $rs2['courseID']   . '","Grade": "' . $rs2['grade'] . '","Attribute": "' . $rs2['attribute'] . '"},';
		  break ;
		  }
	  }
	  if ($rs['courseID'] == "CMPS 211") {
		  $getc = 'SELECT courseID ,grade, attribute From enrolls natural join ge_verify WHERE username = "' .$data . '" and courseID = "'.$rs['courseID'].'" ;' ;
          $true1 = $db_conx->query($getc) ;
		  foreach($true1 as $rs1) {
		  $outp = $outp . '{"Course" :"' . $rs1['courseID']   . '","Grade": "' . $rs1['grade'] . '","Attribute": "' . $rs1['attribute'] . '"},';
		  break ;
		  }
	  
      }
}


echo  '{"courses" : [' . substr($outp ,0, -1) . ']}' ;
?>
