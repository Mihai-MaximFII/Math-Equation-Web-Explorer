<?php
session_start();
include_once('model/threadManip.php');
include_once('model/exerciseManip.php');
include_once ('model/logsManip.php');
if(isset($_POST['CreateThreadSubmit']))
{ $logs=new logsManip();
  $threads=new threadManip();
  if(((isset($_SESSION['Username']))&&(empty($_POST['CreateThreadRequestAnon']))))
  {$threads->insertThread($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
   $logs->insertLog($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],1);
  }
  else
  {$threads->insertThread($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
      $logs->insertLog($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],1);
  }
   sleep(1);
   header("Location: home.php?PressMe=".$_POST['CreateThreadRequestTitle']);
}


if(isset($_POST['CreateExerciseSubmit']))
{
    $exercises=new exerciseManip();
    if(((isset($_SESSION['Username']))&&(empty($_POST['CreateExerciseRequestAnon']))))
    {$exercises->insertExercise($_SESSION['Username'],$_POST['CreateExerciseRequestTitle'],$_POST['CreateExerciseRequestCategory'],$_POST['CreateExerciseRequestComments']);
    }
    else
    {$exercises->insertExercise($_SESSION['Anon'],$_POST['CreateExerciseRequestTitle'],$_POST['CreateExerciseRequestCategory'],$_POST['CreateExerciseRequestComments']);

    }

}


?>