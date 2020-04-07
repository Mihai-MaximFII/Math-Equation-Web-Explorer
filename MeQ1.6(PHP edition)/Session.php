<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="chatBox.css">
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <?php
    $f = @fopen("mesaje.txt", "r+");
    if ($f !== false) {
    ftruncate($f, 0);
    fclose($f);
    }
    if(isset($_SESSION['username'])){
    include 'dbh.ini.php';
    $sql="SELECT *FROM mesaje;";
    $result=mysqli_query($conn,$sql);
    $resultCheck=mysqli_num_rows($result);
    if($resultCheck>0){
        while($row=mysqli_fetch_assoc($result)){
            $fp=fopen('mesaje.txt','a');
            $text='<p>'.$row['Username'].':'.$row['Message'].'</p>'.PHP_EOL;
            fwrite($fp,$text);
            fclose($fp);
        }
    }

     ?>
    <div class="Container2" ID="chatBox">
        <?php
        include 'mesaje.txt';
        ?>
        <form class="chatForm"method="GET" action="sendMessage.php" >
        <input type="text" name="message">
        <button type="Submit" style="margin-left:260px;">Send message</button>
        </form>
    </div>
    <?php
   }
   else
   {
    ?>
    <form method="GET" action="Session.php">
    <input type="text" name="username">
    <button type="submit" name="startchat" value="set">Enter chat</button>
    </form>
    <?php
      if(isset($_GET['username'])){$_SESSION['username']=$_GET['username'];header("Refresh:0");}
    ?>
    <?php
   }
   ?>
</body>
</html>