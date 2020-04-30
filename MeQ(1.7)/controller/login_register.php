<?php
include('model/usersManip.php');
include('model/threadManip.php');
session_start();
if(isset($_POST['RegisterRequest']))
{ 
  $users=new usersManip();
  $numOfUsers= $users->verifyUser($_POST['RegisterRequestUsername'],$_POST['RegisterRequestPassword']);
  if($numOfUsers[0]==0)
  {
    ?>
    <script>
    alert("Account created,you may now login!");
    </script>
    <?php
    $users->insertUser($_POST['RegisterRequestUsername'],$_POST['RegisterRequestPassword'],$_POST['RegisterRequestEmail']);
  }
  else
  {
    ?>
    <script>
    alert("Account already exists!");
    </script>
    <?php
  }
}

if(isset($_POST['LoginRequest']))
{  
  $users=new usersManip();
  $numOfUsers= $users->verifyUser($_POST['LoginRequestUsername'],$_POST['LoginRequestPassword']);
  if($numOfUsers[0]==1)
  { 
   $_SESSION['LoggedStatus']='LoggedIn';
   $_SESSION['Username']=$_POST['LoginRequestUsername'];
   ?>
   <script>
   alert("You are now logged in!");
   </script>
   <?php
  }

}
?>