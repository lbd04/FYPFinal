
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$course = $_POST['course'];

$getc = 'insert into temp values( "'.$course.'","'.$data .'");' ;
$true = $db_conx->query($getc) ;
echo $true ;
?>
