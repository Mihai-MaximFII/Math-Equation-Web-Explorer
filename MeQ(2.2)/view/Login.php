<?php
echo '
        
        <p style="text-align:center;padding-left: 190px">Enter username and password.</p>
        <form method="POST">
         <div class="formLine">
      <label class="left">Username:</label>
      <input type="text"  name="LoginRequestUsername" class="right" placeholder="Enter Username"  name="LoginRequestUsername"required />
        </div>
         <div class="formLine">
      <label class="left">Password:</label>
      <input type="password"  name="LoginRequestPassword" class="right" placeholder="Enter Password"  name="LoginRequestPassword"required />
        </div>
          <div class="formLine">
        <button class="PostButton" name="LoginRequest" ><center>Login</center></button>
         </div>
        
        </form>
'
?>