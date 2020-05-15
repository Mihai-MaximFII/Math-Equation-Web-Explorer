<?php
require_once('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
session_start();
if(isset($_GET['GetLogs'])) {
    $logs = new logsManip();
    $threads=new threadManip();
    $logs = $logs->getLogs();
    foreach ($logs as $log) {
        $thread=$threads->getThreadByTitle($log['Title']);
        if(!empty($thread))
            $exists=1;
       else $exists=0;
        $time=explode(" ",$log['updated_at']);
           if($log['Category']==1){
               if($exists==1) {
                   echo '<p>' . $log['Frm'] . ' created a new thread: ' . "<a target='_top' href='../home.php?PressMe=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
               }}
           else
               if($log['Category']==2){
                   if($exists==1) {
                       echo '<p>' . $log['Frm'] . ' posted a new reply in ' . "<a target='_top' href='../home.php?PressMe=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                   }}
               else
                   if($log['Category']==3) {
                       echo '<p>' . $log['Frm'] . ' deleted his thread:  ' . $log['Title'] . '<br>' . $log['updated_at'] . '</p>';
                   }
                   else
                       if($log['Category']==4){
                           if($exists==1) {
                               echo '<p>' . $log['Frm'] . ' updated his thread :' . "<a target='_top' href='../home.php?PressMe=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                           }}
                             else
                                 if($log['Category']==5){
                                     if($exists==1) {
                                         echo '<p>' . $log['Frm'] . ' deleted a reply in ' . "<a target='_top' href='../home.php?PressMe=" . $log['Title'] . "'" . ">" . $log['Title'] . "</a>" . '<br>' . $log['updated_at'] . '</p>';
                                     }}
                                     else
                                         if($log['Category']==6)
                                             if($exists==1)
                                                 echo '<p>'.$log['Frm'].' updated a reply in '."<a target='_top' href='../home.php?PressMe=".$log['Title']."'".">".$log['Title']."</a>".'<br>'.$log['updated_at'].'</p>';

    }
}