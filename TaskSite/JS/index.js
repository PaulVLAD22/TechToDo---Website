var action_opened=0;
var action_to_open=0;
//1-peek 2-log in 3-sign up


function load_form(){
  // check if there was an attmep to lig in/ peek/sign up in that case you show that
  if (action_to_open!=3){  
    action_to_open+=1;
  }
  else{
    action_to_open=1;
  }
  if (signup_failed!=''){
    action_to_open=3;
  }
  else if (login_failed!=''){
    action_to_open=2;
  }
  else if (peek_failed!=''){
    action_to_open=1;
  }
  document.getElementById("action_form").method="POST";
  if (action_to_open==1){//peek
    document.getElementById("action_message").innerHTML="Peek<button id='change_action_btn' onclick='load_form()'>        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-repeat' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>          <path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/>          <path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/>        </svg>      </button>";
    document.getElementById("action_form").action="../Back-End/peek.php";
    document.getElementById("action_form").innerHTML="<label>Username<img id='peek_img' src='../pics/magnifier.png'></label>        <input type='text' name='username_input'> <h3 id='error_message'>"+peek_problem+"</h3>       <input type='submit' value='Peek' class='submit_btn'>"
  }
  else if (action_to_open==2){//login
    document.getElementById("action_message").innerHTML="Log in<button id='change_action_btn' onclick='load_form()'>        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-repeat' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>          <path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/>          <path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/>        </svg>      </button>";
    document.getElementById("action_form").action="../Back-End/login.php";
    document.getElementById("action_form").innerHTML="<label for ='username_input'>Username</label>        <input type='text' name='username_input'>        <label for='password_input'>Password</label>        <input type='password' name='password_input'><a id='forgot_password' onclick='display_forgot_password()'>Forgot Password?</a>  <h3 id='error_message'>"+login_problem+"</h3>      <input class='submit_btn' type='submit' value='Log in'>"
  }
  else if (action_to_open==3){//signup
    document.getElementById("action_message").innerHTML="Sign up<button id='change_action_btn' onclick='load_form()'>        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-repeat' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>          <path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/>          <path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/>        </svg>      </button>";
    document.getElementById("action_form").action="../Back-End/signup.php";
    document.getElementById("action_form").innerHTML="<label for='username_input'>Username</label>        <input type='text' name='username_input'>        <label for='password_input'>Password</label>        <input type='password' name='password_input'>        <label for='password_confirm_input'>Confirm Password</label>        <input type='password' name='password_confirm_input'>        <label for='email_input'>Email</label>        <input type='email' name='email_input'><h3 id='error_message'>"+signup_problem+"</h3><input type='submit' value='Sign Up' class='submit_btn'>";
  }
  signup_failed='';
  signup_problem='';
  login_failed='';
  login_problem='';
  peek_failed='';
  peek_problem='';

}
function display_forgot_password(){
  document.getElementById("action_message").innerHTML="Reset<button id='change_action_btn' onclick='load_form()'>        <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-repeat' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>          <path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/>          <path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/>        </svg>      </button>";
  document.getElementById("action_form").action="../Back-End/forgot_password.php";
  document.getElementById("action_form").innerHTML="<label>Email<img id='forgot_pass_img' src='../pics/message.png'></label>        <input type='text' name='email_input'> <h3 id='error_message'></h3>       <input type='submit' value='Submit' class='submit_btn'>"
}