<?php
require_once('/fenrir/studs/mihai.maxim/html/model/chatManip.php');
session_start();
if(isset($_POST['SubmitMessage'])) {

    $chat = new chatManip();
    if(isset($_SESSION['Username']))
    $chat->insertMessage($_SESSION['Username'],$_POST['Message']);
    else
        $chat->insertMessage($_SESSION['Anon'],$_POST['Message']);



}

if(isset($_GET['GetMessages'])) {
    $chat = new chatManip();
    $messages = $chat->getAllMessages();
    foreach ($messages as $message) {
        $time=explode(" ",$message['updated_at']);
        if(isset($_SESSION['Username'])&&($_SESSION['Username']!=$message['Frm'])) {
            echo '<div Class="ContainerDiv">';
            echo '<div Class="MessageOthers">';
            echo '<p Class="Paragraph">' . '&nbsp;' . $time[1] . '&nbsp;' . $message['Frm'] . ':' . $message['Content'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        else
        if(isset($_SESSION['Username'])&&($_SESSION['Username']==$message['Frm']))
        {
            echo '<div Class="ContainerDiv">';
            echo '<div Class="MessageYou">';
            echo '<p Class="Paragraph">'  . $message['Content'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        else
            if(!isset($_SESSION['Username'])&&($_SESSION['Anon']!=$message['Frm']))
            {
                echo '<div Class="ContainerDiv">';
                echo '<div Class="MessageOthers">';
                echo '<p Class="Paragraph">' . '&nbsp;' . $time[1] . '&nbsp;' . $message['Frm'] . ':' . $message['Content'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            else
                if(!isset($_SESSION['Username'])&&($_SESSION['Anon']==$message['Frm'])){
                    echo '<div Class="ContainerDiv">';
                    echo '<div Class="MessageYou">';
                    echo '<p Class="Paragraph">'  . $message['Content'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
    }

}