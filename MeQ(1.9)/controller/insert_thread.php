<?php
session_start();
include_once('model/threadManip.php');
if(isset($_POST['CreateThreadSubmit']))
{ 
  $threads=new threadManip();
  if(((isset($_SESSION['Username']))&&(empty($_POST['CreateThreadRequestAnon'])))&&(!empty($_FILES['CreateThreadRequestFile'])))
  $threads->insertThread($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
  else
      if((!empty($_FILES['CreateThreadRequestFile'])))
      $threads->insertThread($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
      else
      {
          ?>
          <script type="text/javascript">
              alert("Image required!");

          </script>
          <?php
      }
}
?>