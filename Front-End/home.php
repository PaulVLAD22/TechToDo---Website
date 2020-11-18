<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <?php
  
  session_start();
  $loggedin=false;
  $peeking = false;
  if (isset($_SESSION['loggedin']))
    $loggedin=true;
  else if (isset($_SESSION['peeking']))
    $peeking=true;
  else
    die("Log in!/Peek!");
  include '../Back-End/get_tasks.php';
  $username = $_SESSION['username'];
 
  $add_basic_task_ok=false;
  $add_private_task_ok=false;
  if (isset($_SESSION['add_basic_task_ok'])){
    $add_basic_task_ok=true;
  }
  if (isset($_SESSION['add_private_task_ok'])){
    $add_private_task_ok=true;
  }
  ?>
  <style>
    <?php
    include '../CSS/home.css';
    ?>
  </style>
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
  </script>
  <script>
    var peeking ='<?php echo $peeking;?>';
    var loggedin ='<?php echo $loggedin;?>';
    var array_basic_tasks='<?php echo js_array($array_basic_tasks);?>';
    var array_private_tasks='<?php echo js_array($array_private_tasks);?>';
    var array_completed_tasks='<?php echo js_array($array_completed_tasks);?>';
    var add_basic_task_ok ='<?php echo $add_basic_task_ok;?>';
    var add_private_task_ok = '<?php echo $add_private_task_ok;?>';
     <?php
    include "../JS/home.js";
    ?>
  </script>
  
</head>
<body onload=load_tasks()>
<div id="top_bar">
  <?php 
  if ($loggedin==true)
  echo "<button class='top_button'>-Logged In-</button>";
  else
    echo "<button class='top_button' >-Peeking-</button>";
  ?>
  <button class="top_button"><?php echo $username."'s Tasks"?></button>
  <form action="../Back-End/switch_user.php" method="post"><input class="top_button" id='logout_btn' type="submit" value="Switch User"></form>
</div>
<div id="box-container">
  <div class="box" id="box-1">
    <img id="active_tasks_icon" src="../pics/notepad.png" alt="Active Tasks">
    <div id="active_tasks_div" class="tasks_div">
    <span class="tasks_title">Active<?php if ($loggedin) echo '<button class="tasks_add_btn" onclick="add_basic_task()">+</button>'?></span>
    <div class="tasks_list" id="active_tasks_list"></div>
    </div> 
  </div>
  <div class="box" id="box-2">
    <img id="completed_tasks_icon" src="../pics/check.png" alt="Completed Tasks">
    <div id="completed_tasks_div" class="tasks_div">
    <span class="tasks_title">Completed</span>
    <div class="tasks_list" id="completed_tasks_list"></div>
    </div>
  </div>
  <div class="box" id="box-3">
    <img id="private_tasks_icon" src="../pics/speech-bubble.png" alt="Private Tasks">
    <div id="private_tasks_div" class="tasks_div">
    <span class="tasks_title">Private<?php if ($loggedin) echo '<button class="tasks_add_btn" onclick="add_private_task()">+</button>'?></span>
    <div class="tasks_list" id="private_tasks_list"></div>
    </div>
  </div>
</div>
</body>
</html>