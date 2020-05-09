<?php
session_start();
include('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
if(isset($_GET['DeleteThread'])&&isset($_SESSION['Username']))
{
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