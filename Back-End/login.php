<?php
$configs = include('config.php');
session_start();
//resetting sign up errors
unset($_SESSION['signup_failed']);
unset($_SESSION['forgot_password_failed']);
unset($_SESSION['peek_failed']);

if (isset ($_POST["username_input"]) && isset($_POST["password_input"])){
  $username = $_POST["username_input"];
  $password = $_POST["password_input"];

  $uncompleted_fields = false;

  if (strlen($username) == 0 || strlen($password) == 0)
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
      // o sa schimbi sql incat sa faci join intre account si active si completed tasks si
      //private tasks
      // si le iei pe alea si le arati cu butoane
      // active are X SI Y 
      // completed nu are
      //private are doar
      $stmt = $conn->prepare($sql);

      $stmt->bind_param("s",$username);

      $stmt->execute();

      $result = $stmt->get_result();

      $correct_account=false;
      $email='';
      $account_id='';
      $status = '';
      /* ia informatie


      */

      while ($row = $result->fetch_assoc()){
        if (password_verify($password,$row['password'])){
          $account_id=$row['account_id'];
          $status=$row['status'];
          $email =$row['email'];
          $correct_account=true;
        }
      }
      $stmt->close();
      $conn->close();

      if($correct_account==true){
        session_start();
        $_SESSION['email']=$email;
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        $_SESSION['account_id']=$account_id;
        unset($_SESSION['peeking']);
        if ($status=='inactive'){
          header('location:/TaskSite/Front-End/activatePage.php');
        }
        else{
          header('location:/TaskSite/Front-End/home.php');
        }

      }
      else{
        session_start();
        $_SESSION['login_failed']=true;
        $_SESSION['login_problem']='Wrong Details';
        header('location:/TaskSite/Front-End/index.php');
      }

  }
  else{
    session_start();
    $_SESSION['login_failed']=true;
    $_SESSION['login_problem']="Uncompleted Fields";
    header('location:/TaskSite/Front-End/index.php');
  }

}
else{
  session_start();
  $_SESSION['login_failed'] = true;
  $_SESSION['login_problem']= 'Stop Playing';
  header('location:/TaskSite/Front-End/index.php');
}


?>