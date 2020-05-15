<?php

include_once('../controller/chat_controller.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../view/chatStyle.css">
</head>
<body>
<div ID="Messages" class="MessagesText">

</div>
<div style="width: 100%;height: 10px;position: relative;">

</div>

</body>
<script>

    window.setInterval(showUser, 1000);

    function showUser() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Messages").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../controller/chat_controller.php?GetMessages=set", true);
        xmlhttp.send();

    }


</script>
</html>
