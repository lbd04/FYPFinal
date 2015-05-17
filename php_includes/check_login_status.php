<?php
session_start();
include_once("db_conx.php");
// Files that inculde this file at the very top would NOT require
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_username = "";
$log_password = "";
// User Verify function
function evalLoggedUser($conx,$u,$p){
    $sql = "SELECT username FROM student WHERE username='$u' AND password='$p' AND confirmed='1' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
    if($numrows > 0){
        return true;
    }
	else {
		return false ;
	}
}
if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    //check to see if any for any smarty ass user played with his cookie data
    
    $log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
    $log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
    // Verify the user
    $user_ok = evalLoggedUser($db_conx,$log_username,$log_password);
}

?>
