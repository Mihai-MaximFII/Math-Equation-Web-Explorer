<?php

ini_set('display_errors', 1);
include('controller/login_register.php');
include('controller/insert_thread.php');
include('controller/thread_xml.php');
include('controller/insert_image.php');
session_start();
if(!isset($_SESSION['Anon'])){
$var="Anon".rand(10,10000);
$_SESSION["Anon"]=$var;}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="view/Style.css">

</head>
  
<body>
    <header>
    <ul id="Subjects">
    <li>MeQ</li>
    <li>Algebra</li>
    <li>Trigonometrie</li>
    <li>Geometrie</li>
    <li>Analiza</li>
    <li><button onclick="display('Register')" class="RegularButton blue">Register</button></li>
    <li><button onclick="display('Login')" class="RegularButton green">Login</button></li>
    <li>
    <div id="Searchbar">
    <form id="Searchform" method="get">
        <button type="submit" id="SearchButton"> Search</button>
        <input type="text" name="message" id="SearchInput" placeholder="ex:Teorema lui Pitagora">
    </form>
</div>

</li>

</ul>

    </header>

    <div class="content">
        <div class="leftSide">
        <h4><div id="User"></div></h4>
        <ul id="NavList">
                <li onclick=""><strong>Home</strong></li>
                <li onclick="display('LiveChat')"><strong>Live chat</strong></li>
                <li onclick="displayThreads()"><strong>Browse Threads</strong></li>
                <li onclick="display('newThread')"><strong>Start new thread</strong></li>
            </ul>
           
        </div>
        <div class="rightSide">

            <?php
            include ('controller/right_side_controller.php');
            ?>
          
        </div>
    </div>
    

    <footer>
        <form method="GET">
            <button type="submit"  id="ThreadPress" name="PressMe"  >Start new thread then click me</button>
        </form>
    </footer>
    <script>
        
        function display(id){
            let el = document.getElementById(id);
            let divs = document.getElementsByClassName('Container');
            for(let i=0;i<divs.length;i++){
                if(divs[i] == el){
                    divs[i].style.display="block";
                }
                else{
                    divs[i].style.display="none";
                }
            }
        }
        function displayThreads()
        {
            document.getElementById('ThreadPress').click();
        }

    
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

