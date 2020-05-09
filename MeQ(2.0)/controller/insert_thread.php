<?php
session_start();
include_once('model/threadManip.php');
if(isset($_POST['CreateThreadSubmit']))
{ 
  $threads=new threadManip();
  if(((isset($_SESSION['Username']))&&(empty($_POST['CreateThreadRequestAnon']))))
  $threads->insertThread($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
  else
      $threads->insertThread($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
    ?>
    <script>
        alert("Thread submited!");
    </script>
    <?php
}
?>