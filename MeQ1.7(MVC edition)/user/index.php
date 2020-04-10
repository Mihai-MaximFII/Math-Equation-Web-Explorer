<?php
include('C:\xampp\htdocs\MVC\model\usersManip.php');
include('C:\xampp\htdocs\MVC\model\threadManip.php');
if(isset($_GET['RegisterRequest']))
{ 
  $users=new usersManip();
  $users->insertUser($_GET['RegisterRequestUsername'],$_GET['RegisterRequestPassword'],$_GET['RegisterRequestEmail']);
  echo $_GET['RegisterRequestUsername'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style.css">

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


        </ul>

        <div id="Searchbar">
            <form>
                <input class="favorite styled"
                       type="button"
                       value="Search"
                       id="SearchButton">

                <input type="text" name="message" id="SearchInput" placeholder="ex:Teorema lui Pitagora">
            </form>
        </div>
    </header>

    <div class="content">
        <div class="leftSide">
            <ul id="NavList">
                <li onclick="display('mainFeed')"><strong>Home</strong></li>
                <li onclick="display('LiveChat')"><strong>Live chat</strong></li>
                <li onclick="display('hotTopics')"><strong>See hot topics</strong></li>
                <li onclick="display('newThread')"><strong>Start new thread</strong></li>
            </ul>
        </div>
        <div class="rightSide">
            <div class="Container" id="newThread">
             <form method="POST">
                <div class="formLine">
                    <label for="Categorii" class="left">Categorie:</label>
                     <select name="Category" class="right Categorii">
                         <option value="Geometrie">Geometrie</option>
                         <option value="Algebra">Algebra</option>
                         <option value="Trigonometrie">Analiza</option>
                         <option value="Trigonometrie">Trigonometrie</option>
                     </select>
                 </div>
                <div class="formLine">
                    <label for="Categorii" class="left">Titlu:</label>
                     <input type="text"  name="Category" class="right"/>
                 </div>
                 <div class="formLine">
                    <label for="comments"class="left">Comentariu:</label>
                    <textarea name="comments" rows="10" maxlength="2000" cols="50" class="right resize"></textarea>
                 </div>
                 <div class="formLine">
                <label for="fileInput" class="left">Ataseaza fisier:</label>
                <input type="file" accept="image/*"  class="right adjustText" >
                 </div>
                 <div class="formLine" >
                  <label for="anon" class="left checkboxLabel">Posteaza ca anonim:</label>
                  <input type="checkbox" name="anonymous"  class="right checkbox">
                 </div>

             </form>
             <button class="PostButton"><center>Start new thread</center></button>
            </div>

            <div class="Container" id="hotTopics">
             <iframe src="postContainer.php"></iframe>
            </div>
            <div class="Container" id="Login">

              <div class="loginStyle">
                <label for="Username"><b>Username</b></label>
                <input type="Username"  placeholder="Enter Username" name="uname" required >

                <label for="Password"><b>Password</b></label>
                <input type="Password" placeholder="Enter Password"  name="psw" required>
                 <button type="submit" class="RegularButton gray">Login</button>
                 <label>
                 <input type="checkbox" checked="checked" name="remember"> Remember me
                 </label>
              </div>
            </div>
            <div class="Container" id="Register">
               <div class="registerStyle">
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="email"><b>Email</b></label>
                    <label for="psw"><b>Password</b></label>
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <form method="GET">
                    <input type="text" placeholder="Enter Email" name="RegisterRequestEmail" required>
                    <input type="password" placeholder="Enter Username" name="RegisterRequestUsername" required>
                    <input type="password" placeholder="Enter Password" name="RegisterRequestPassword" required>
                    <button type="submit" class="RegularButton gray" name="RegisterRequest">Register</button>
                    </form>

                    <hr>

                  <div class="container signin">
                    <p>Already have an account? <a href="#" onclick="display('Login')">Login</a>.</p>
                  </div>
                </div>
            </div>
            <div  class="Container" id="LiveChat">
              <iframe class="chatContainer" src="Session.php"></iframe>
            </div>

        </div>
    </div>
    

    <footer>
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
    
    </script>
     
</body>
</html>

