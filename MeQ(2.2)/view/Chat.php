<?php


session_start();
?>
<div ID="Chat" style="display: none">
    <div class="Messages" id="Messages">
        <iframe style=" border-radius: 10px; background-color: #f5f5f5; width:100%;height: 100%;  transform: rotate(180deg); border: 1px solid grey;" src="view/Messages.php">

        </iframe>

    </div>
    <div ID="Input" class="Input">
        <hr style="border-radius: 15px">
        <form id="myForm" target="frame" method="POST" >
            <textarea rows="4"  maxlength="5000" cols="50" name="Message" ID="ReplyTextId" class="InputText"></textarea>
            <button ID="InputButton"  onclick="clearReplyInput()" type="submit"  class="InputButton" name="SubmitMessage">Reply</button>
        </form>
    </div>
    <iframe style="display: none" name="frame"></iframe>
</div>
