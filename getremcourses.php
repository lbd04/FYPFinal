<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];

$getc = 'SELECT * From coursescount WHERE username = "' .$data . '";' ;
$true = $db_conx->query($getc) ;
$outp ="" ;

foreach($true as $rs) { 
	 $outp = $outp . '{ "nature" :"Major Elective" ,"number" :"' . $rs['majorelective']   . '" },{ "nature" :"Free Elective" ,"number" :"' . $rs['free']   . '" } , { "nature" :"1" ,"number" :"' . $rs['social2']   . '" } ,{ "nature" :"Required Math/Stat " , "number" :"'.$rs['requiredmath'] .'" },{"nature" : "Required Science"  ,"number" : "'.$rs['requiredscience'].'" },{"nature" :"Arabic" , "number" : "'.$rs['arabic'].'" },{ "nature" :"English" ,"number" : "'.$rs['english'].'" },{ "nature" :"CVSP 1" , "number" : "'.$rs['cvsp1'].'" },{ "nature" :"CVSP 2" ,"number" : "'.$rs['cvsp2'].'" },{ "nature" :"Quantitative" , "number" : "'.$rs['quantative'].'" },{ "nature" :"Social science" , "number" : "'.$rs['social1'].'" },{ "nature" :"Natural Science" ,"number" : "'.$rs['naturale'].'" },{ "nature" :"Humanity" ,"number" : "'.$rs['humanity1'].'" },';                                                               //
break ;
	 }
   echo   '{"courses" :[' . substr($outp ,0, -1) . '] }' ;
?>

