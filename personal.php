
<?php
include_once("php_includes/db_conx.php");

$username = preg_replace('#[^a-z0-9]#i', '', $_POST['username']);
$password = preg_replace('#[^a-z0-9]#i', '', $_POST['password']);
$sql = "SELECT username FROM student WHERE username='$username' AND confirmed= 1 AND password='$password' LIMIT 1";
    $query = $db_conx->query($sql) ;
    $uname_check = mysqli_num_rows($query);
	$row = mysqli_fetch_row($query);

    if($uname_check == 1){

	 echo "$username";
	
    }
   else {  
        echo "0" . "Failed to login";
        exit();
    }
	
?>