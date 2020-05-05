<?php

$right_side='
<div class="Container" id="newThread">
    <form method="POST" enctype="multipart/form-data">
       <div class="formLine">
           <label for="Categorii" class="left">Categorie:</label>
            <select name="CreateThreadRequestCategory" class="right Categorii">
                <option value="Geometrie">Geometrie</option>
                <option value="Algebra">Algebra</option>
                <option value="Trigonometrie">Analiza</option>
                <option value="Trigonometrie">Trigonometrie</option>
            </select>
        </div>
       <div class="formLine">
           <label class="left">Titlu:</label>
            <input type="text"  name="CreateThreadRequestTitle" class="right" required />
        </div>
        <div class="formLine">
           <label for="comments"class="left">Comentariu:</label>
           <textarea name="CreateThreadRequestComments" rows="10" maxlength="2000" cols="50" class="right resize" required></textarea>
        </div>
        <div class="formLine">
       <label for="fileInput" class="left">Ataseaza fisier:</label>
       <input type="file" accept="image/*" name="CreateThreadRequestFile" value="set" class="right adjustText" required >
        </div>
        <div class="formLine" >
         <label for="anon" class="left checkboxLabel">Posteaza ca anonim:</label>
         <input type="checkbox" name="CreateThreadRequestAnon"  class="right checkbox">
        </div>
        <div class="formLine">
        <button class="PostButton" name="CreateThreadSubmit" value="ThreadSubmited"><center>Start new thread</center></button>
        </div>
    </form>
   
   </div>

   <div class="Container" id="hotTopics">

   </div>
   <div class="Container" id="Login">

     <div class="registerStyle">

       <label for="Username"><b>Username</b></label>
       <label for="Password"><b>Password</b></label>
       <form method="POST">
       <input type="Username"  placeholder="Enter Username" name="LoginRequestUsername" required >
       <input type="Password" placeholder="Enter Password"  name="LoginRequestPassword" required>
        <button type="submit" class="RegularButton gray" name="LoginRequest" value="LoginRequestSet">Login</button>
        </form>
     </div>
   </div>
   <div class="Container" id="Register" >
        <div class="formLine">
        <div class="registerStyle">
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <label for="psw"><b>Password</b></label>
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <form method="POST">
        <input type="text" placeholder="Enter Email" name="RegisterRequestEmail" required>
        <input type="text" placeholder="Enter Username" name="RegisterRequestUsername" required>
        <input type="password" placeholder="Enter Password" name="RegisterRequestPassword" required>
        <button type="submit" class="RegularButton gray" name="RegisterRequest" >Register</button>
        </form>

        <hr>

      <div class="container signin">
        <p>Already have an account? <a href="#" onclick=">display("Login")">Login</a>.</p>
      </div>
</div>
  </div>
   </div>
   <div  class="Container" id="LiveChat">
     <iframe class="chatContainer" ></iframe>
   </div>';
   echo $right_side;
?>