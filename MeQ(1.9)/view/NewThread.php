<?php
echo ' <form method="POST" enctype="multipart/form-data">
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
            <input type="text"  name="CreateThreadRequestTitle" class="right" max="80" placeholder="Max length:80 characters" required />
        </div>
        <div class="formLine">
           <label for="comments"class="left">Comentariu:</label>
           <textarea name="CreateThreadRequestComments" rows="10"  maxlength="5000" cols="50" class="right resize" placeholder="Max length:5000 characters" required></textarea>
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
        <button class="PostButton" name="CreateThreadSubmit" value="ThreadSubmited" ><center>Start new thread</center></button>
        </div>
    </form>';
