<?php
$configs = include('config.php');
function js_str($s)
{
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function js_array($array)
{
    $temp = array_map('js_str', $array);
    return implode(',', $temp);
}
// session already started in home.php
$account_id=$_SESSION['account_id'];

$dbservername = $configs['host'];
$dbusername = $configs['username'];
$dbpassword = $configs['password'];
$dbName = $configs['dbname'];

$array_basic_tasks=[];
$array_private_tasks=[];
$array_completed_tasks=[];

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbName);

if ($conn->connect_error)
  die("Connection failed: " . $conn->connect_error);

//basic_tasks
$sql = "SELECT * from basic_tasks where account_id = ? ;";
// o sa schimbi sql incat sa faci join intre account si active si completed tasks si
//private tasks
// si le iei pe alea si le arati cu butoane
// active are X SI Y 
// completed nu are
//private are doar
$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $account_id);

$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){
  array_push($array_basic_tasks,$row['task_name']);
}

//private_tasks

$sql_private = "SELECT * FROM private_tasks where account_id = ? ;";
$stmt_private = $conn->prepare($sql_private);
$stmt_private->bind_param("s",$account_id);
$stmt_private->execute();
$result = $stmt_private->get_result();

while ($row = $result->fetch_assoc()){
  array_push($array_private_tasks,$row['task_name']);
}

//completed_tasks
$sql_completed = "SELECT * FROM completed_tasks where account_id = ? ;";
$stmt_completed = $conn->prepare($sql_completed);
$stmt_completed->bind_param("s",$account_id);
$stmt_completed->execute();
$result = $stmt_completed->get_result();

while ($row = $result->fetch_assoc()){
  array_push($array_completed_tasks,$row['task_name']);
}




$stmt->close();
$conn->close();
