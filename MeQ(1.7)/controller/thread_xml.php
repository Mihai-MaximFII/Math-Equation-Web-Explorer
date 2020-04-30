<?php
include_once('model/threadManip.php');

if(isset($_GET["PressMe"])){
include_once('model/imageManip.php');
$xml = new DOMDocument("1.0","UTF-8");
$xml->load('view/threads.xml');
$threads=new threadManip();
$results=$threads->getAllThreads();

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
   $rootTag->appendChild($thread);
   $xml->save('view/threads.xml');  
 }
 header("Location: view/threads.xml");
}

?>