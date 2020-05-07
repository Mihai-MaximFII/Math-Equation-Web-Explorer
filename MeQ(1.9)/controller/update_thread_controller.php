<?php
session_start();
include('/fenrir/studs/mihai.maxim/html/model/usersManip.php');



if(isset($_GET['UpdateThread']))
{

    $users=new usersManip();
    $users->updateThreadContentById($_GET['UpdateThread'],$_GET['PostText']);
    ?>
    <script type="text/javascript">
    alert("Thread updated!");
     location="../home.php?PressMe='";

   </script>
    <?php


}