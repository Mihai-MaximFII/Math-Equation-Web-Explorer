<?php

include('/fenrir/studs/mihai.maxim/html/model/replyManip.php');
include('/fenrir/studs/mihai.maxim/html/model/usersManip.php');
include('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
session_start();
if(isset($_POST['CreateReplySubmit']))
{  if(!empty($_POST['CreateReplyRequestText']))
    if((!empty($_POST['CreateReplyRequestText']))&&((isset($_FILES['CreateReplyRequestFile']))))
    {
        $users=new usersManip();
        $user=$users->getUser($_SESSION['Username']);

        $replies=new replyManip();
        if(isset($_FILES['CreateReplyRequestFile']))
        {

            $threads=new threadManip();
            $rows=$threads->getThreadIdByUser($_SESSION['Username']);
            $ID=$rows[0]['ID'];
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
                        $replies->insertReply($user[0]['ID'],$_POST['CreateReplySubmit'],$_POST['CreateReplyRequestText'],$filenew);
                        $xml = new DOMDocument("1.0","UTF-8");
                        $xml->load('view/threads.xml');
                        $elements = $xml->getElementsByTagName('Thread');
                        for ($i = $elements->length; --$i >= 0; ) {
                            $href = $elements->item($i);
                            $href->parentNode->removeChild($href);
                        }
                        $xml->save('view/threads.xml');

                        ?>
                        <script>
                            alert("File uploaded!");
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
                    alert("Wrong image format!");
                </script>
                <?php

            }
        }


    }
sleep(3);
header('Location: ../home.php?PressMe=');


}


