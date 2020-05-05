<?php
include('model/usersManip.php');
include('model/threadManip.php');
session_start();
if(isset($_POST['RegisterRequest']))
{ 
  $users=new usersManip();
  $numOfUsers= $users->verifyUser($_POST['RegisterRequestUsername']);
  $numOfEmails=$users->verifyUserEmail($_POST['RegisterRequestEmail']);
  if($numOfEmails[0]==1)
  {
      ?>
      <script>
          alert("An account is already associated with this email!");
      </script>
      <?php
  }
  else
  if($numOfUsers[0]==0)
  {


      if (!filter_var($_POST['RegisterRequestEmail'], FILTER_VALIDATE_EMAIL)) {
          ?>
          <script>
              alert("Email format is invalid!");
          </script>
          <?php
      }
      else
          if(preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['RegisterRequestUsername'])) {
              $users->insertUser($_POST['RegisterRequestUsername'],$_POST['RegisterRequestPassword'],$_POST['RegisterRequestEmail']);
              ?>
              <script>
                  alert("Account created,you may now login!");
              </script>
              <?php
          }
          else
          {
              ?>
              <script>
                  alert("Wrong username format:letters and numbers only,min length=5 characters!");
              </script>
              <?php
          }

  }
  else
  {
    ?>
    <script>
    alert("Account already exists!");
    </script>
    <?php
  }
    unset($GLOBALS['RegisterRequest']);

}

if(isset($_POST['LoginRequest']))
{  
  $users=new usersManip();
  $numOfUsers= $users->verifyUserLogin($_POST['LoginRequestUsername'],$_POST['LoginRequestPassword']);
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
  else
  {
      ?>
      <script>
          alert("Wrong username/password!");
      </script>
      <?php
  }

}
?>