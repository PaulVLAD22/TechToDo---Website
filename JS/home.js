var add_basic_opened=0;
var add_private_opened=0;



if (add_basic_task_ok!=''){
  add_basic_opened=0;
}
if (add_private_task_ok!=''){
  add_private_opened=0;
}

array_basic_tasks = array_basic_tasks.split(',');
array_private_tasks = array_private_tasks.split(',');
array_completed_tasks = array_completed_tasks.split(',');
function load_tasks(){
  //basic_tasks always loaded
  if (loggedin!=''){
    if (!(array_basic_tasks.length==1 && array_basic_tasks[0]==""))
      for (let i=0;i<array_basic_tasks.length;i++){
        document.getElementById("active_tasks_list").innerHTML+='<div class="task" id="task-'+i+'"><p class="task_name" id="task_name'+i+'">'+array_basic_tasks[i].substring(1,array_basic_tasks[i].length-1)+'</p><form action="../Back-End/modify_basic_task.php" method="post" class="check_mark_form"><input type="submit" value="Y('+(i+1)+')" name="y_input" class="task_btn_tick" id="btn_Y_'+i+'" ><input type="submit" name="x_input" value="X('+(i+1)+')" class="task_btn_mark" id="btn_X_'+(i+1)+'"><input id="task_hidden_input" name="task_hidden_input" value ="'+array_basic_tasks[i].substring(1,array_basic_tasks[i].length-1)+'"></form></div>';
      }
    if (!(array_private_tasks.length==1 && array_private_tasks[0]==""))
      for (let i=0;i<array_private_tasks.length;i++){
        document.getElementById("private_tasks_list").innerHTML+='<div class="task" id="task-'+i+'"><p class="task_name" id="task_name'+i+'">'+array_private_tasks[i].substring(1,array_private_tasks[i].length-1)+'</p><form action="../Back-End/remove_private_task.php" method="post" class="check_mark_form"><input type="submit" value="Y('+(i+1)+')" name="y_input" class="private_task_btn_tick" id="btn_Y_'+i+'" disabled="disabled" ><input type="submit" name="x_input" value="X('+(i+1)+')" class="private_task_btn_mark" id="btn_X_'+i+'"><input id="task_hidden_input" name="task_hidden_input" value ="'+array_private_tasks[i].substring(1,array_private_tasks[i].length-1)+'"></form></div>';
      }
    if (!(array_completed_tasks.length==1 && array_completed_tasks[0]==""))
      for (let i=0;i<array_completed_tasks.length;i++){
        document.getElementById("completed_tasks_list").innerHTML+='<div class="task" id="task-'+i+'"><p class="task_name" id="task_name'+i+'">'+array_completed_tasks[i].substring(1,array_completed_tasks[i].length-1)+'</p><form action="../Back-End/remove_completed_task.php" method="post" class="check_mark_form"><input type="submit" value="Y('+(i+1)+')" name="y_input" class="completed_task_btn_tick" id="btn_Y_'+i+'" disabled="disabled" ><input type="submit" name="x_input" value="X('+(i+1)+')" class="completed_task_btn_mark" id="btn_X_'+i+'"><input id="task_hidden_input" name="task_hidden_input" value ="'+array_completed_tasks[i].substring(1,array_completed_tasks[i].length-1)+'"></form></div>';
      } 
    
  }
  else if (peeking!=''){
    if (!(array_basic_tasks.length==1 && array_basic_tasks[0]==""))
      for (let i=0;i<array_basic_tasks.length;i++){
        document.getElementById("active_tasks_list").innerHTML+='<div class="task" id="task-'+i+'"><p class="task_name" id="task_name'+i+'">'+array_basic_tasks[i].substring(1,array_basic_tasks[i].length-1)+'</p></div>';
      }
      if (!(array_completed_tasks.length==1 && array_completed_tasks[0]==""))
      for (let i=0;i<array_completed_tasks.length;i++){
        document.getElementById("completed_tasks_list").innerHTML+='<div class="task" id="task-'+i+'"><p class="task_name" id="task_name'+i+'">'+array_completed_tasks[i].substring(1,array_completed_tasks[i].length-1)+'</p></div>';
      } 
  }

}




function add_basic_task(){
  if (add_basic_opened==0){
    document.getElementById("active_tasks_div").innerHTML+='<div class="task" id="add_task_div"><form action="../Back-End/add_basic_task.php" method="post"><input type="text" id="new_task_input" name="task_name_input"><input class="submit_task_btn" type="submit" value="Add task"></form></div>';
    add_basic_opened=1;
  }
}
function add_private_task(){
  if(add_private_opened==0){
    document.getElementById("private_tasks_div").innerHTML+='<div class="task"><form action="../Back-End/add_private_task.php" method="post"><input type="text" id="new_task_input" name="task_name_input"><input class="submit_task_btn" type="submit" value="Add task"></form></div>';
    add_private_task=1;
  }
}



// TODO: SA FACI SA MEARGA JQUERY 
// butoanele de check , remove active , remove private, remove completed
// switch user , destroy session  si reset all tasks 
// Design: Fa butoanele la marginea dreapta a divului