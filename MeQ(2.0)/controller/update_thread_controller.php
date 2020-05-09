<?php
session_start();
include('/fenrir/studs/mihai.maxim/html/model/usersManip.php');



if(isset($_GET['UpdateThread']))
{

    $users=new usersManip();
    $users->updateThreadContentById($_GET['UpdateThread'],"UPDATED:".$_GET['PostText']);
    $title=$users->getTitleById($_GET['UpdateThread']);
    sleep(3);
    header("Location: ../home.php?PressMe=".$title[0]['Title']);


}