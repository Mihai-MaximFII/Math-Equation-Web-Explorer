<?php
include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManipUser.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/threadManip.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/logsManip.php');
session_start();
if(isset($_POST['DeleteReply']))
{


    $replies=new replyManipUser();
    $title=$replies->getThreadTitleByReplyId($_POST['DeleteReply']);
    $threadID=$replies->getThreadIdByReplyId($_POST['DeleteReply']);
    $relevance=$replies->getRelevance($threadID[0][0]);
    $replies->setRelevance($threadID[0][0],$relevance[0]);
    $replies->deleteReplyById($_POST['DeleteReply']);

    $users=new threadManip();
    $logs=new logsManip();
    $title=$users->getTitleById($threadID[0][0]);
    $logs->insertLog($_SESSION['Username'],$title[0]['Title'],5);

    sleep(2);
    header("Location: ../home.php?PressMe=".$title[0]['Title']);

}
if(isset($_POST['UpdateReply']))
{
    $message=$_POST['ReplyRequestText'];
    $replies=new replyManipUser();
    $title=$replies->getThreadTitleByReplyId($_POST['UpdateReply']);
    $replies->updateReplyById($_POST['UpdateReply'],'UPDATED:'.$message);

    $logs=new logsManip();

    $logs->insertLog($_SESSION['Username'],$title[0]['Title'],6);

    sleep(1);
    header("Location: ../home.php?PressMe=".$title[0]['Title']);
}
