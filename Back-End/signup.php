<?php
use PHPMAILER\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$configs = include('config.php');
$configs = include('config.php');
session_start();
//
unset($_SESSION['login_failed']);
unset($_SESSION['forgot_password_failed']);
unset($_SESSION['peek_failed']);
if (isset ($_POST["username_input"]) && isset($_POST["password_input"])
&& isset($_POST["password_confirm_input"]) && isset($_POST["email_input"])){
  $username = $_POST["username_input"];
  $password = $_POST["password_input"];
  $confirm_pass = $_POST['password_confirm_input'];
  $email = $_POST["email_input"];

  $uncompleted_fields = false;
  $different_passwords = false;
  $used_illegal_characters=false;
  $invalid_email=false;

  if (strlen($username) == 0 || strlen($password) == 0 ||
  strlen($confirm_pass) == 0 || strlen($email) == 0)
    $uncompleted_fields = true;

  if ($password != $confirm_pass)
    $different_passwords = true;

  if (!$uncompleted_fields) {
    $atIndex = 0;
    while ($email[$atIndex] != '@') {
      $atIndex++;
      if ($atIndex==strlen($email)){
        $invalid_email=true;
      }
    }
  }

  if (strpos($username,' ')!== false || strpos($password,' ')!== false){
    $usedIllegalCharacters=true;
  }
  if (!$uncompleted_fields && !$different_passwords && !$used_illegal_characters) {
    $dbservername = $configs['host'];
    $dbusername = $configs['username'];
    $dbpassword = $configs['password'];
    $dbName = $configs['dbname'];

    function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    $token = generateRandomString();
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);

    if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);

    
    $sql = "INSERT INTO account (username,password,email,token,status) values(?, ?, ?,?,'inactive');";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssss",$username,password_hash($password,PASSWORD_BCRYPT),$email,$token);

    if ($stmt->execute() === TRUE) {
      session_start();
      //save
      unset($_SESSION['signin_failed']);
      $_SESSION['signup_problem']=''; 
      //
      header('location:/TaskSite/Front-End/index.php');
      //closing db
      $mail = new PHPMailer(true);
      try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'tls://smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'vlavionflights@gmail.com';                     // SMTP username
        $mail->Password   = 'parola34007';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
  
        //Recipients
        $mail->setFrom('vlavionflights@gmail.com', 'Mailer');
        $mail->addAddress($email);     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Sign Up';
        $mail->Body    = 'Hi '.$username.' your token is : '.$token;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
        $mail->send();
        echo 'Message has been sent';
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      $stmt->close();
      $conn->close();
    } else {
      session_start();
      $_SESSION['signup_failed'] = true;
      $_SESSION['signup_problem']='Username already used';

      header('location:/TaskSite/Front-End/index.php');
      //closing db
      $stmt->close();
      $conn->close();
    }
  }
  else{ // input problem 
    session_start();
    echo "INPUT PROBLEM";
    
    $_SESSION['signup_failed'] = true;

    if ($different_passwords) {
      $_SESSION['signup_problem'] = 'Different Passwords';
    }

    if ($used_illegal_characters){
      $_SESSION['signup_problem'] = 'Used Illegal Characters';
    }

    if ($uncompleted_fields) {
      $_SESSION['signup_problem'] ='Uncompleted Fields'; 
    }
    header('location:/TaskSite/Front-End/index.php');

  }

}
else{
  session_start();
  $_SESSION['signup_failed'] = true;
  $_SESSION['signup_problem']= 'Stop Playing';
  header('location:/TaskSite/Front-End/index.php');
}



?>