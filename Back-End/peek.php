<?php
$configs = include('config.php');
session_start();
unset($_SESSION['signup_failed']);
unset($_SESSION['forgot_password_failed']);
unset($_SESSION['login_failed']);



if (isset ($_POST["username_input"])){
  $username = $_POST["username_input"];


  $uncompleted_fields = false;

  if (strlen($username) == 0 )
    $uncompleted_fields = true;

  
  if (!$uncompleted_fields) {
    $dbservername = $configs['host'];
    $dbusername = $configs['username'];
    $dbpassword = $configs['password'];
    $dbName = $configs['dbname'];

      $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);

      if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

      
      $sql = "SELECT * from account where username = ? ;";
      // o sa schimbi sql incat sa faci join intre account si active si completed tasks
      // si le iei pe alea si le arati fara butoane

      $stmt = $conn->prepare($sql);

      $stmt->bind_param("s",$username);

      $stmt->execute();

      $result = $stmt->get_result();

      $correct_account=false;

      $account_id='';
      /* ia informatie


      */

      while ($row = $result->fetch_assoc()){
          $correct_account=true;
          $account_id=$row['account_id'];
      }
      $stmt->close();
      $conn->close();

      if($correct_account==true){
        session_start();
        $_SESSION['username']=$username;
        $_SESSION['account_id']=$account_id;
        $_SESSION['peeking']=true;
        unset($_SESSION['loggedin']);
        header('location:/TaskSite/Front-End/home.php');
      }
      else{
        session_start();
        $_SESSION['peek_failed']=true;
        $_SESSION['peek_problem']='Wrong Details';
        header('location:/TaskSite/Front-End/index.php');
      }

  }
  else{
    session_start();
    $_SESSION['peek_failed']=true;
    $_SESSION['peek_problem']="Uncompleted Fields";
    header('location:/TaskSite/Front-End/index.php');
  }

}
else{
  session_start();
  $_SESSION['peek_failed'] = true;
  $_SESSION['peek_problem']= 'Stop Playing';
  header('location:/TaskSite/Front-End/index.php');
}


?>




?>