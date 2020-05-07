<?php
include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManipUser.php');
session_start();
if(isset($_POST['DeleteReply']))
{
    $replies=new replyManipUser();

    $threadID=$replies->getThreadIdByReplyId($_POST['DeleteReply']);
    $relevance=$replies->getRelevance($threadID[0][0]);
    $replies->setRelevance($threadID[0][0],$relevance[0]);
    $replies->deleteReplyById($_POST['DeleteReply']);



    ?>
    <script type="text/javascript">
        alert("Reply deleted!");
        location="../home.php?PressMe='";

    </script>
    <?php

}
if(isset($_POST['UpdateReply']))
{
    $message=$_POST['ReplyRequestText'];
    $replies=new replyManipUser();
    $replies->updateReplyById($_POST['UpdateReply'],$message);

    ?>
    <script type="text/javascript">
        alert("Reply updated!");
        location="../home.php?PressMe='";

    </script>
    <?php
}
