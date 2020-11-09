<hmtl>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  crossorigin="anonymous">
  <title>TechToDo</title>
  <link rel="icon" href="https://www.flaticon.com/svg/static/icons/svg/768/768818.svg"  type="image/png" >
  <?php
  //sign up failed
  $signup_failed=false;
  $signup_problem="";
  //login failed
  $login_failed = false;
  $login_problem ="";
  //peek failed
  $peek_failed = false;
  $peek_problem ="";
  session_start();
  if (isset($_SESSION['logged_in'])){
    header('location:/home.php');
  }
  else if (isset($_SESSION['signup_failed'])) {
    $signup_failed = true;
    $signup_problem =$_SESSION['signup_problem'];
  }
  else if (isset($_SESSION['login_failed'])){
    $login_failed=true;
    $login_problem=$_SESSION['login_problem'];
  }
  else if (isset($_SESSION['peek_failed'])){
    $peek_failed=true;
    $peek_problem=$_SESSION['peek_problem'];
  }
  ?>
  <style>
    <?php
    include '../CSS/index.css';
    ?>
  </style>
  <script>
    var signup_failed = '<?php echo $signup_failed; ?>';
    var signup_problem = '<?php echo $signup_problem; ?>';
    var login_failed = '<?php echo $login_failed; ?>';
    var login_problem = '<?php echo $login_problem; ?>';
    var peek_failed = '<?php echo $peek_failed; ?>';
    var peek_problem = '<?php echo $peek_problem; ?>';
    // FA SA AFISEZE IN FUNCTIE DE CE AI GRESIT.
     <?php
    include "../JS/index.js";
    ?>
  </script>
</head>
<body onload='load_form()'>
<div id="box-container">
  <div id='box-1'>
  </div>
  <div id='box-2'>
    <div id="box-2_top">
      <h5 id='box-2_slogan'>Your Online Notebook</h5>
      <img id='box-2_note_img' src="../pics/notes.png" alt='Notes pic'>
    </div>
    <div id="login_menu">
      <span id='action_message'>
      </span>
      <form id='action_form'>
      </form>
    </div>
    <img id="logo_icon" src="../pics/logo_icon.png" alt="Logo Icon">
    <h5 class="icon_attribution">Icons made by
      <a href="https://www.flaticon.com/authors/freepik">freepik</a></h5>
  </div>
</div>

</body>
</hmtl>