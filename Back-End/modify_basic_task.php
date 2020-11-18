<?php
$configs = include('config.php');
session_start();
$account_id=$_SESSION['account_id'];

$task_name=$_POST['task_hidden_input'];

$dbservername = $configs['host'];
$dbusername = $configs['username'];
$dbpassword = $configs['password'];
$dbName = $configs['dbname'];
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

if (isset($_POST['y_input'])){//complete task

  $sql = "INSERT INTO completed_tasks values(?, ?);";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("ss",$task_name,$account_id);

  if($stmt->execute()===TRUE)
    echo "OK";

  $sql ="DELETE FROM basic_tasks where account_id= ? and task_name= ? ;";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("ss",$account_id,$task_name);

  if($stmt->execute()===TRUE)
    echo "ok";

  header('location:/TaskSite/Front-End/home.php');
  
  


  
}
else {// remove task

  $sql ="DELETE FROM basic_tasks where account_id= ? and task_name= ? ;";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param("ss",$account_id,$task_name);

  if($stmt->execute()===TRUE)
    echo "ok";

  header('location:/TaskSite/Front-End/home.php');

}


?>