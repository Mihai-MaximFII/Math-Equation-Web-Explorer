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
if(!isset($_SESSION['Category']))
$_SESSION['Category']='All';

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
    <li onclick="displayThreadsAlgebra()">Algebra</li>
    <li onclick="displayThreadsTrigonometrie()">Trigonometrie</li>
    <li onclick="displayThreadsGeometrie()">Geometrie</li>
    <li onclick="displayThreadsAnaliza()">Analiza</li>
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

</ul>

    </header>

    <div class="content">
        <div class="leftSide" id="LeftSide">
        <h4><div id="User"></div></h4>
        <ul id="NavList">
                <li onclick="displayFrame()"><strong>Home</strong></li>
                <li onclick="display('LiveChat')"><strong>Live chat</strong></li>
                <li onclick="displayThreads()"><strong>Browse Threads</strong></li>
                <li onclick="display('newThread')"><strong>Start new thread</strong></li>
            </ul>
           
        </div>
        <div class="rightSide">
            <iframe width="87.4%"  style="border: 1px solid black"id="Frame" frameborder="2px solid black;" src="view/threads.xml">Plm</iframe>
            <div id="rightBanner" style=" position:sticky ;float : right; background-color:#f5f5f5;" ></div>
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
                    document.getElementById('Frame').style.display="none";
                }
            }
        }
        function displayThreads()
        {
            document.getElementById('ThreadPress').click();
        }
        function displayThreadsGeometrie()
        {
            document.getElementById('ThreadPress').value="Geometrie";
            document.getElementById('ThreadPress').click();
        }
        function displayThreadsAlgebra()
        {
            document.getElementById('ThreadPress').value="Algebra";
            document.getElementById('ThreadPress').click();
        }
        function displayThreadsTrigonometrie()
        {
            document.getElementById('ThreadPress').value="Trigonometrie";
            document.getElementById('ThreadPress').click();
        }
        function displayThreadsAnaliza()
        {
            document.getElementById('ThreadPress').value="Analiza";
            document.getElementById('ThreadPress').click();
        }
        function displayFrame()
        {
            let divs = document.getElementsByClassName('Container');
            for(let i=0;i<divs.length;i++){

                    divs[i].style.display="none";
                }
            if(document.getElementById('Frame').style.display!="inline-block")
            document.getElementById('Frame').style.display="inline-block";

        }
        window.addEventListener('resize', function(event){
            var body = document.body,
                html = document.documentElement;

            var height = Math.max( body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight );

            document.getElementById('Frame').style.height=String(height)+"px";
            document.getElementById('LeftSide').style.height=String(height)+"px";
            document.getElementById('rightBanner').style.height=String(height)+"px";
            document.getElementById('rightBanner').style.width='12%';

        });
            var body = document.body,
                html = document.documentElement;

            var height = Math.max( body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight );

            document.getElementById('Frame').style.height=String(height)+"px";
            document.getElementById('LeftSide').style.height=String(height)+"px";
            document.getElementById('rightBanner').style.height=String(height)+"px";
            document.getElementById('rightBanner').style.width='12%';






    
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

