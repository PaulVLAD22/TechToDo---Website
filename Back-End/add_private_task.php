<?php
$configs = include('config.php');
session_start();
$account_id =$_SESSION['account_id'];
unset($add_private_task_ok);
unset($_add_private_task_failed);
if (isset($_POST['task_name_input'])){
  $task_name = $_POST['task_name_input'];
  $empty_task = false;


  if (strlen($task_name)==0){
    $empty_task=true;
  }

  if (!$empty_task){
    $dbservername = $configs['host'];
    $dbusername = $configs['username'];
    $dbpassword = $configs['password'];
    $dbName = $configs['dbname'];

    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);

    if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);

    
    $sql = "INSERT INTO private_tasks values(?, ?);";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss",$task_name,$account_id);

    if ($stmt->execute()===TRUE){
      session_start();
      $_SESSION['add_private_task_ok']=true;
      header('location:/TaskSite/Front-End/home.php');
    }
    else{
      header('location:/TaskSite/Front-End/home.php');
    }
  }
  else{
    header('location:/TaskSite/Front-End/home.php');
  }
}
else{
  header('location:/TaskSite/Front-End/home.php');
}



?>