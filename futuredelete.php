
<?php
include_once("php_includes/db_conx.php");
header("Access-Control-Allow-Origin: *");
$data = $_POST['username'];
$course = $_POST['course'];

$getc = 'delete from temp where  courseID = "'.$course.'"and username="'.$data .'" ;' ;
$true = $db_conx->query($getc) ;

?>
