<?php
include_once('model/threadManip.php');
include_once('model/usersManip.php');
session_start();
if(isset($_GET["PressMe"])){
include_once('model/imageManip.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManip.php');
$xml = new DOMDocument("1.0","UTF-8");
$xml->load('view/threads.xml');
$threads=new threadManip();
$results=$threads->getAllThreads();
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
   $replies=$repliesManip->getAllReplies();
   foreach ($replies as $reply)
   {
         if($reply['THREAD_ID']==$row[ID]){

         $Reply = $xml->createElement("Reply");
         $ReplyContent = $xml->createElement('ReplyContent', $reply['CONTENT']);
         $ReplyDate = $xml->createElement('ReplyDate', $reply['UPDATED_AT']);
         $ReplyImage = $xml->createElement('ReplyImage', $reply['IMAGE_NAME']);
         $user = $usersMan->getUserById($reply['USER_ID']);
         $ReplyUsername = $xml->createElement('ReplyUsername', $user[0]);
         $Reply->appendChild($ReplyUsername);
         $Reply->appendChild($ReplyContent);
         $Reply->appendChild($ReplyDate);
         $Reply->appendChild($ReplyImage);
         $thread->appendChild($Reply);
         $rootTag->appendChild($thread);
         }
         else
        $rootTag->appendChild($thread);
   }






   $xml->save('view/threads.xml');  
 }

 header("Location: view/threads.xml");
}

?>