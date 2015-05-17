
<?php

    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('Some fields are missing');       
    }
     
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_from = $_POST['email'];
    $comments = $_POST['comments'];
     
    $error_message = "";
include ("Mail.php") ;
   require "Mail.php";
 
   // Identify the sender, recipient, mail subject, and body
   $sender    = "louay.dimassi4@gmail.com";
   $recipient = "louay.dimassi4@gmail.com";
   $subject   = "Test mail";
   $body      = "Ciao Cristian, questa è una mail";
 
   // Identify the mail server, username, password, and port
   $server   = "ssl://smtp.gmail.com";
   $username = "louay.dimassi4@gmail.com";
   $password = "skyline4@";
   $port     = "465";
 
   // Set up the mail headers
   $headers = array(
      "From"    => $sender,
      "To"      => $recipient,
      "Subject" => $first_name
   );
 
   // Configure the mailer mechanism
   $smtp = Mail::factory("smtp",
      array(
        "host"     => $server,
        "username" => $username,
        "password" => $password,
        "auth"     => true,
        "port"     => 465
      )
   );
 
   // Send the message
   $mail = $smtp->send($recipient, $headers, $body);
 
   if (PEAR::isError($mail)) {
      echo ($mail->getMessage());
   }
?>

<?php
}
header("Location: index.php");
die();
?>