<?php
session_start();
include ("/fenrir/studs/mihai.maxim/html/model/usersManip.php");
include ('/fenrir/studs/mihai.maxim/html/model/chatManip.php');
$users=new usersManip();
$chatManip=new chatManip();


if (!isset($_SESSION['Username']))
    {echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>You are limited to the public all chat!</strong></p>';
    echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>Log in to send private messages!</strong></p>';}
else {
    echo '<form method="POST">';
    echo '<input type="text" name="Contact" style="max-width:80%";>';
    echo '<button style="display: inline;" name="addContact">Add contact</button>';
    echo '</form>';
}



if(isset($_POST['addContact'])&&isset($_SESSION['Username']))
{   $user=$users->getUser($_POST['Contact']);
    if(!empty($user) &&($_POST['Contact']!=$_SESSION['Username']))
    {
        $ifContact=$chatManip->checkIfContact($_SESSION['Username'],$_POST['Contact']);
        if($ifContact[0][0]==0)
        $chatManip->insertMessageTo($_SESSION['Username'],"/.*/",$_POST['Contact']);


    }
    else {
        ?>
        <script>
            alert('User does not exist!');
        </script>
        <?php
    }
}


if (isset($_POST['SelectedContact'])) {
    $_SESSION['TalkingTo'] = $_POST['SelectedContact'];
    echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>Talking to:' . $_SESSION['TalkingTo'].'</strong></p>';
}
if (isset($_POST['AllChat'])) {
    unset($_SESSION['TalkingTo']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body  >
<div id="Contacts" style="width: 100%; "   >

</div>
</body>

<script>
    window.setInterval(showContacts, 1000);

    function showContacts() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Contacts").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../controller/chat_friend_controller.php?GetContacts=set", true);
        xmlhttp.send();


    }




</script>

</html>



