<?php

include('/fenrir/studs/mihai.maxim/html/model/replyManip.php');
include('/fenrir/studs/mihai.maxim/html/model/usersManip.php');
include('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
session_start();
if(isset($_POST['CreateReplySubmit']))
{  if(!empty($_POST['CreateReplyRequestText'])){
    if((!empty($_POST['CreateReplyRequestText']))&&((isset($_FILES['CreateReplyRequestFile']))))
    {
        $users=new usersManip();
        $user=$users->getUser($_SESSION['Username']);


        $replies=new replyManip();
        if(isset($_FILES['CreateReplyRequestFile']))
        {

            $threads=new threadManip();
            if(isset($_SESSION['Username']))
            {$rows=$threads->getThreadIdByUser($_SESSION['Username']);
                $ID=$rows[0];}
            else
            {$rows=$threads->getThreadIdByUser($_SESSION['Anon']);
            $ID=$rows[0];}


            $file=$_FILES['CreateReplyRequestFile'];
            $name=$_FILES['CreateReplyRequestFile']['name'];
            $fileTmp=$_FILES['CreateReplyRequestFile']['tmp_name'];
            $size=$_FILES['CreateReplyRequestFile']['size'];
            $error=$_FILES['CreateReplyRequestFile']['error'];
            $type=$_FILES['CreateReplyRequestFile']['type'];
            $filext=explode('.',$name);
            $filextlow=strtolower(end($filext));
            $allowed=array('jpg','jpeg','png');

            if(in_array($filextlow,$allowed))
            {
                if($error===0){
                    if($size<1000000)
                    {
                        $filenew=uniqid('',true).".".$filextlow;
                        $destination='/fenrir/studs/mihai.maxim/html/view/images/'.$filenew;
                        move_uploaded_file($fileTmp,$destination);
                        if(isset($_SESSION['Username'])) {
                            $replies->insertReply($user['ID'], $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], $filenew);
                            $relevance=$threads->getRelevance( $_POST['CreateReplySubmit']);
                            $threads->setRelevance( $_POST['CreateReplySubmit'],$relevance[0][0]);
                        }
                        else {
                            $replies->insertReplyAnon(0, $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], $filenew, $_SESSION['Anon']);
                            $relevance=$threads->getRelevance($rows[0]['ID']);
                            $threads->setRelevance( $rows[0]['ID'],$relevance[0][0]);
                        }



                        ?>
                        <script>
                            alert("Reply created!");
                        </script>
                        <?php

                    }
                    else
                    {  ?>
                        <script>
                            alert("File too big!");
                        </script>
                        <?php
                    }
                }
                else
                {   ?>
                    <script>
                        alert("Upload failed!");
                    </script>
                    <?php
                }

            }
            else
            {?>
                <script>
                    alert("Image and text required!");
                </script>
                <?php

            }
        }


    }
}
else
{?>
    <script>
        alert("Image and text required!");
    </script>
    <?php

}


    ?>
    <script type="text/javascript">
        location="../home.php?PressMe='";

    </script>
    <?php

}


