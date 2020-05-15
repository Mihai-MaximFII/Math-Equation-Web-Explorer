<?php
session_start();
include_once('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
if(isset($_GET['DeleteThread'])&&isset($_SESSION['Username']))
{
    $users=new threadManip();
    $logs=new logsManip();
    $title=$users->getTitleById($_GET['DeleteThread']);
    $logs->insertLog($_SESSION['Username'],$title[0]['Title'],3);

    $threads=new threadManip();
    $threads->deleteThreadById($_GET['DeleteThread']);
    sleep(3);
    ?>
    <script type="text/javascript">
        alert("Thread deleted!");
        location="../home.php?PressMe=";

    </script>
    <?php



}