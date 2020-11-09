<?php
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

    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);

    if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);

    
    $sql = "INSERT INTO account (username,password,email) values(?, ?, ?);";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss",$username,password_hash($password,PASSWORD_BCRYPT),$email);

    if ($stmt->execute() === TRUE) {
      session_start();
      //save
      unset($_SESSION['signin_failed']);
      $_SESSION['signup_problem']=''; 
      //
      header('location:/TaskSite/Front-End/index.php');
      //closing db
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