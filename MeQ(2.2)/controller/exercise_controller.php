<?php

include_once ("../model/exerciseImageManip.php");
require('/fenrir/studs/mihai.maxim/public_html/controller/exercise_reply_controller.php');
session_start();

if(isset($_GET['te']))
{

    $exerc=new exerciseManip();
    $images=new exerciseImageManip();
    $exercise=$exerc->getExerciseByTitle($_SESSION['Exercise']);
    $image=$images->getExerciseImageFromId($exercise[0]['ID']);
   echo '<a  target="_parent" id="DeleteRedirect"  href="/~mihai.maxim/controller/exercises_xml.php?e=&noRedirect=true&Special=true">Back</a>';

   echo '<div Class="Exercise">';
   echo '<div Class=ImageExercise>';
      if(!empty($image)) echo '<img onclick="image(this)" style="width: 100%;height: 100%; max-height: 100px;max-width: 90px;" src="../view/images/'.$image[0]['IMG_NAME'].'">';
      else
      {
          ?>
           <script>
               document.getElementsByClassName("ImageExercise")[0].style.display="none";
           </script>
  <?php
      }
   echo ' </div>';

    if($exercise[0]['Username']==$_SESSION['Username'])
    { echo '<form method="POST">';}

   echo ' <div Class="TitleExercise">';
   echo '<textarea name="TitleContent" readonly="readonly"; style="width: 395px;height: 35px; text-align: center; resize: none;">';
   echo $exercise[0]['Title'];
   echo '</textarea>';
   echo  '</div>';
    if($exercise[0]['Username']==$_SESSION['Username'])
        {

            echo '<button name="DeleteExercise">Delete</button>';
            echo '</form>';

        }
    if($exercise[0]['Username']==$_SESSION['Username'])
    {
        echo '<form method="POST">';
    }

   echo '<div Class="ContentExercise">';
   echo '<textarea name="UpdateExerciseContent" readonly="readonly" style="width:500px; resize: none">';
   echo $exercise[0]['Content'];
   echo '</textarea>';
   echo '</div>';
   echo '</div>';

    if($exercise[0]['Username']==$_SESSION['Username'])
    {

        echo '<button name="UpdateExerciseContentButton">Update</button>';
        echo '</form>';
        ?>
         <script>
           let v=  document.getElementsByTagName("textarea");
                 v[1].readOnly="";
         </script>
  <?php


    }
    if(isset($_POST['UpdateExerciseContentButton']))
    {
      $exerc->updateExerciseContentById($exercise[0]['ID'],"UPDATED:".$_POST['UpdateExerciseContent']);
      header("Location:/~mihai.maxim/view/ExerciseView.php?te=".$_SESSION['Exercise']);
    }
    if(isset($_POST['DeleteExercise']))
    {
       $exerc->deleteExerciseById($exercise[0]['ID']);

        ?>
      <script>
        alert("Exercise deleted!");
       document.getElementById("DeleteRedirect").click();
      </script>
<?php
    }
    $exerciseReplies=new exerciseReplyManip();
    $replies=$exerciseReplies->getAllExerciseReplies();
    $usr=new usersManip();
    foreach ($replies as $reply) {
        if ($reply['EXERCISE_ID'] == $exercise[0]['ID']) {
            $user = $usr->getUserById($reply['USER_ID']);
            echo '<div class="Reply">';
            echo '<div class="ReplyContent">';
            if (($_SESSION['Username'] == $user[0]) && (isset($_SESSION['Username']))) {
                echo '<form method="post">';
                echo '<textarea name="ReplyText"  style="width: 98%;height: 95%; resize: none;overflow-y: hidden;">';
                echo $reply['CONTENT'];
                echo '</textarea>';
                echo '<button name="UpdateReply" value="' . $reply['REPLY_NUMBER'] . '">';
                echo 'Update';
                echo '</button>';

                echo '<button name="DeleteReply" value="' . $reply['REPLY_NUMBER'] . '">';
                echo 'Delete';
                echo '</button>';

                echo '</form>';
            } else {
                echo '<textarea class="text1" readonly="readonly"; style="width: 98%;height: 95%; resize: none;overflow-y: hidden;">';
                echo $reply['CONTENT'];
                echo '</textarea>';
            }
            echo "</div>";

            echo '<div class="ReplyInfo">';
            echo '<textarea  readonly="readonly";  style="width: 97%;height: 95%; resize: none;overflow-y: hidden;">';
            echo "By:" . $user[0];
            echo '</textarea>';

            echo '</div>';
            echo '<div class="ReplyImage">';
            if (!empty($reply['IMAGE_NAME']))
                echo '<img onclick="imageReply(this)" style="max-width:50px;max-height:50px;"src="../view/images/' . $reply['IMAGE_NAME'] . '">';
            echo $reply['IMG_NAME'];
            echo '</div>';
            echo '</div>';


        }
    }
    if(isset($_POST['UpdateReply']))
    {
        $exerciseReplies->updateExerciseReplyById($_POST['UpdateReply'],'UPDATED:'.$_POST['ReplyText']);

        header("Refresh:0");
    }

    if(isset($_POST['DeleteReply']))
    {
        $exerciseReplies->deleteExerciseReplyById($_POST['DeleteReply']);
        header("Refresh:0");

    }

    echo '<form  enctype="multipart/form-data" method="POST" style="margin-top: 10px;">';
    echo '<textarea name="CreateExerciseReplyRequestText"style=" width: 80%;height: 100px; resize: none">';

    echo '</textarea>';
    echo '<br>';
    echo '<button name="CreateExerciseReplySubmit" value="'.$exercise[0]['ID'].'">';
    echo 'Post';
    echo '</button>';
    echo ' <input type="file" accept="image/*,application/pdf,application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint,
text/plain,application/vnd.openxmlformats-officedocument.presentationml.presentation" name="CreateExerciseReplyRequestFile" value="set">';
    echo '</form>';







}