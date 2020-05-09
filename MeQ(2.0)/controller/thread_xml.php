<?php
include_once('model/threadManip.php');
include_once('model/usersManip.php');
session_start();
if(isset($_GET["PressMe"])||isset($_GET["SearchButton"])){
include_once('model/imageManip.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManip.php');
$xml = new DOMDocument("1.0","UTF-8");
$xml->load('view/threads.xml');
$threads=new threadManip();
$stopHeading=0;
if(empty($_GET["PressMe"])) {
    $results = $threads->getAllThreads();
    $_SESSION['Category']='';
}
else
if($_GET["PressMe"]=="Geometrie"){
$results=$threads->getAllThreadsGeometrie();
$stopHeading=1;
$_SESSION['Category']='Geometrie';}
else
if($_GET["PressMe"]=="Algebra"){
$results=$threads->getAllThreadsAlgebra();
$stopHeading=1;
$_SESSION['Category']='Algebra';}
else
if($_GET["PressMe"]=="Trigonometrie"){
$results=$threads->getAllThreadsTrigonometrie();
$stopHeading=1;
$_SESSION['Category']='Trigonometrie';}
else
if($_GET["PressMe"]=="Analiza") {
$results = $threads->getAllThreadsAnaliza();
$stopHeading=1;
$_SESSION['Category']='Analiza';
}
else
if($_GET["PressMe"]=="Newest")
{  if($_SESSION['Category']!='')
    {
     $results=$threads->getAllThreadsNewest($_SESSION['Category'],'ID');
       usort($results, function($a, $b) {
            return $b['ID'] - $a['ID'];
        });
    }
    else
    {
        $results = $threads->getAllThreads();
        usort($results, function($a, $b) {
            return $b['ID'] - $a['ID'];
        });
    }
}
else
    if($_GET["PressMe"]=="Oldest")
    {
        if($_SESSION['Category']!='') {
            $results = $threads->getAllThreadsOldest($_SESSION['Category'], 'ID');
            usort($results, function($a, $b) {
                return $a['ID'] - $b['ID'];
            });
        }
        else
        {
            $results = $threads->getAllThreads();
            usort($results, function($a, $b) {
                return $a['ID'] - $b['ID'];
            });
        }

    }
    else
        if($_GET["PressMe"]=="Replies")
        {
            if($_SESSION['Category']!='') {
                $results = $threads->getAllThreadsOldest($_SESSION['Category'], 'ID');
                usort($results, function($a, $b) {
                    return $b['Relevance'] - $a['Relevance'];
                });
            }

        }



else
{
    $results=$threads->getThreadByTitle($_GET["PressMe"]);
    $stopHeading=0;
}
unset($_GET["PressMe"]);
    if(isset($_GET["SearchButton"])){
        if(!empty($_GET["SearchMessage"]))
        {
            $msg= '%'.str_replace(' ','%',$_GET['SearchMessage']).'%';
            $results=$threads->getThreadsByList($msg);
            if(empty($results))
            {
                ?>
                <script type="text/javascript">
                 alert('Input not found!')
                </script>
                <?php

            }
            $stopHeading=1;
        }
        else{
            ?>
            <script type="text/javascript">
                alert('No input to search!')
            </script>
            <?php
            $stopHeading=1;
           }

    }

$repliesManip=new replyManip();
$usersMan=new usersManip();



$elements = $xml->getElementsByTagName('Thread');
for ($i = $elements->length; --$i >= 0; ) {
  $href = $elements->item($i);
  $href->parentNode->removeChild($href);
}


$images=new imageManip();

foreach($results as $row) {
    
   $rootTag=$xml->getElementsByTagName('Threads')->item(0);
   $user=$xml->createElement('User');
   $text=$xml->createTextNode($row['Username']);
   $user->appendChild($text);
   $title=$xml->createElement('Title',$row['Title']);
   $category=$xml->createElement('Category',$row['Category']);
   $content=$xml->createElement('Content',$row['Content']);
   $date=$xml->createElement('Date',$row['updated_at']);
   $idtag=$xml->createElement('Id',$row['ID']);
   $id=$row['ID'];
   $id=$images->getThreadImageFromId($id);
   $stock="stocknigga.png";
   if($id===0)
   $image=$xml->createElement('Image',$stock);
   else
   $image=$xml->createElement('Image',$id[0]['IMG_NAME']);

   $thread=$xml->createElement("Thread");

   $thread->appendChild($user);
   $thread->appendChild($title);
   $thread->appendChild($category);
   $thread->appendChild($content);
   $thread->appendChild($image);
   $thread->appendChild($date);
   $thread->appendChild($idtag);
    if(strcmp($row['Username'],$_SESSION['Username'])==0)
    {
        $threadAdmin=$xml->createElement('ThreadAdmin',$row['ID']);
    }
    else
        $threadAdmin=$xml->createElement('ThreadAdmin',-1);
    $thread->appendChild($threadAdmin);
   $replies=$repliesManip->getAllReplies();
   if(count($replies)==0)
       $rootTag->appendChild($thread);

   foreach ($replies as $reply)
   {
         if($reply['THREAD_ID']==$row[ID]){

         $Reply = $xml->createElement("Reply");
         $ReplyContent = $xml->createElement('ReplyContent', $reply['CONTENT']);
         $ReplyDate = $xml->createElement('ReplyDate', $reply['UPDATED_AT']);
         $ReplyImage = $xml->createElement('ReplyImage', $reply['IMAGE_NAME']);
         $user = $usersMan->getUserById($reply['USER_ID']);
         if(!empty($user))
         $ReplyUsername = $xml->createElement('ReplyUsername', $user[0]);
         else
             $ReplyUsername = $xml->createElement('ReplyUsername', $reply['Anon']);


         $Reply->appendChild($ReplyUsername);
         $Reply->appendChild($ReplyContent);
         $Reply->appendChild($ReplyDate);
         $Reply->appendChild($ReplyImage);
             if((strcmp($user[0],$_SESSION['Username'])==0)&&isset($_SESSION['Username']))
             {
                 $replyAdmin=$xml->createElement('ReplyAdmin',$reply['REPLY_NUMBER']);
             }
             else
                 $replyAdmin=$xml->createElement('ReplyAdmin',-1);
             $Reply->appendChild($replyAdmin);
             $thread->appendChild($Reply);
             $rootTag->appendChild($thread);
         }
         else
        $rootTag->appendChild($thread);
   }






   $xml->save('view/threads.xml');  
 }
//*
 if($stopHeading==0)
  header("Location: view/threads.xml");
  else
  {  ?>
      <script type="text/javascript">
         location="home.php";
      </script>
      <?php
     // header("Location: home.php");
  }

//*/


}

?>