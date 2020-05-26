<?php
session_start();
if(isset($_SESSION['Pages'])) {
    $nrOfPages = $_SESSION['Pages']/10;


    for($i=0;$i<$nrOfPages;$i=$i+1)
    {
       echo '<a target="_parent" href="../home.php?e=&Page='.$i.'">'.$i.'</a>';
       echo '&nbsp;';
    }
    }