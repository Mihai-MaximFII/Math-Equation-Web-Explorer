<?php

ini_set('display_errors', 1);
include('controller/login_register.php');
include('controller/insert_thread.php');
include('controller/thread_xml.php');
include('controller/insert_image.php');
include('/fenrir/studs/mihai.maxim/html/controller/chat_controller.php');
include('/fenrir/studs/mihai.maxim/html/controller/reply_detection.php');

session_start();
if(!isset($_SESSION['Anon'])){
$var="Anon".rand(10,10000);
$_SESSION["Anon"]=$var;}
if(!isset($_SESSION['Category']))
$_SESSION['Category']='';


if(!isset($_SESSION['ReplyLimit']))
$_SESSION['ReplyLimit'] ='true';

if(!isset($_SESSION['NewReplies']))
    $_SESSION['NewReplies'] ='';

if(!isset($_SESSION['NewRepliesShow']))
    $_SESSION['NewRepliesShow'] ='false';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="view/Style.css">
    <link rel="stylesheet" type="text/css" href="view/chatStyle.css">
    <link rel="stylesheet" type="text/css" href="view/activityLog.css">


</head>
  
<body>
    <header id="Header">
    <ul id="Subjects">
    <li>MeQ</li>
    <li onclick="displayThreadsAlgebra()"><u  id="Alg"  class="Shortcut">Algebra</u></li>
    <li onclick="displayThreadsTrigonometrie()"><u id="Trig" class="Shortcut">Trigonometrie</u></li>
    <li onclick="displayThreadsGeometrie()"><u id="Geo" class="Shortcut">Geometrie</u></li>
    <li onclick="displayThreadsAnaliza()"><u id="Ana" class="Shortcut">Analiza</u></li>
    <li><button onclick="display('Register')" class="RegularButton blue">Register</button></li>
    <li><button onclick="display('Login')" class="RegularButton green">Login</button></li>
    <li>
    <div id="Searchbar">
    <form id="Searchform" method="get">
        <button type="submit" id="SearchButton" name="SearchButton"> Search</button>
        <input type="text" name="SearchMessage" id="SearchInput" placeholder="ex:Teorema lui Pitagora">
    </form>
</div>

</li>
        <li style="font-size: 10px;
     font-size: 20px;"><U><?php if($_SESSION['Category']!='') echo 'Chosen category:'.$_SESSION['Category'];?></U></li>
        <li id="Notification" style="font-size: 10px;
        font-size: 20px;"><U></U></li>

</ul>


    </header>

    <div class="content">
        <div class="leftSide" id="LeftSide">
        <h4><div id="User"></div></h4>
        <ul id="NavList">
                <li onclick="displayFrame()"><strong>Home</strong></li>
                <li onclick="displayChat()"><strong>Live chat</strong></li>
                <li onclick="displayThreads()"><strong>Browse Threads</strong></li>
                <li onclick="display('newThread')"><strong>Start new thread</strong></li>
                <li onclick="displayActiviyLog()"><strong>Activity log</strong></li>
            </ul>
           
        </div>
        <div class="rightSide">
            <iframe width="80%"  style="border: 0px solid black;border-radius: 15px;"id="Frame" src="view/threads.xml">Plm</iframe>
            <div id="rightBanner" style=" position:sticky ;float : right; background-color:#f5f5f5;" >
                <div id="Activity log" style="display: block">
                    <div class="Logs" id="Logs">
                        <h2 style=" font-family :'Comic Sans MS';opacity: 65%;">Activity log</h2>
                        <iframe style=" border-radius: 10px; background-color: #f5f5f5; width:100%;height: 100%;  transform: rotate(180deg); border: 1px solid grey;" src="view/Logs.php">

                        </iframe>

                    </div>
                </div>
            </div>
            <?php
            include ('controller/right_side_controller.php');
            ?>

            <?php
            include ('view/Chat.php');
            ?>


        </div>
    </div>
    

    <footer>
        <form method="GET">
            <button type="submit"  id="ThreadPress" name="PressMe"  >Start new thread then click me</button>
        </form>
    </footer>
  <script src="controller/Scripts.js">

  </script>
     
</body>
<?php
if(isset( $_SESSION['LoggedStatus']))
{
    ?>
    <script>
     var name='<?php echo $_SESSION['Username'];?>';
     document.getElementById('User').innerHTML='Wellcome: <br> </br>'+" "+name;
     document.getElementById('User').style.display="block";
</script>

<?php

}

?>
</html>

