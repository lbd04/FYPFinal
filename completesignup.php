
<?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
// CONNECT TO THE DATABASE
include_once("php_includes/db_conx.php");
// GATHER THE POSTED DATA INTO LOCAL VARIABLES
$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
$e = mysqli_real_escape_string($db_conx, $_POST['e']);
$p = $_POST['p'];
$m = preg_replace('#[^a-z0-9 	]#i', '', $_POST['m']);
$arabic =  intval($_POST['arabic']) ;
$english =  intval($_POST['english']) ;
$n = preg_replace('#[^a-z0-9 ]#i', '', $_POST['n']);
// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
$sql = "SELECT username FROM student WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
$u_check = mysqli_num_rows($query);
// -------------------------------------------
// FORM DATA ERROR HANDLING
if($u == "" || $e == "" || $p == "" || $m == "" || $n == ""){
echo "The form submission is missing values.";
        exit();
} else if ($u_check > 0){
        echo "The username you entered is alreay taken";
        exit();
}  else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit();
    }
     else {
// END FORM DATA ERROR HANDLING
// Begin Insertion of data into the database
// Hash the password and apply your own mysterious unique salt
/*$cryptpass = crypt($p);
include_once ("php_includes/randStrGen.php");
$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);*/

$p_hash=$p;//to be changed later!!!
// Add user info into the database table for the main site table
$sql = "INSERT INTO student (name, username, major, confirmed, password)
       VALUES('$n','$u','$m','0','$p_hash')";
$query = mysqli_query($db_conx, $sql);

if (strcmp ($m , "cmps") ==0) {
	$arabic = 1 - $arabic ;
	$english = 2 - $english ;
	$sql = 'INSERT INTO coursescount 
       VALUES( "' . $u . '" ,12, 3, 3, 2, '.$arabic.', '.$english.', 1 , 1 , 1 , 2,1 , 2 ,2 ) ;';
    $query = mysqli_query($db_conx, $sql);
}
else if (strcmp ($m , "MATH") ==0) {
	//$sql = "INSERT INTO student (name, username, major, confirmed, password)
  //     VALUES('$n','$u','$m','0','$p_hash')";
 //   $query = mysqli_query($db_conx, $sql);
	
}
else if (strcmp ($m , "PSYC") == 0) {
	//$sql = "INSERT INTO student (name, username, major, confirmed, password)
  //     VALUES('$n','$u','$m','0','$p_hash')";
//$query = mysqli_query($db_conx, $sql);
	
}

// Email the user their activation link

echo "signup_success";
exit();
}
exit();
}
?>