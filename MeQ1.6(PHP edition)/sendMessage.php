
<?php
session_start();
include 'dbh.ini.php';
$var1=$_SESSION['username'];
$var2=$_GET['message'];
if(var2!=null) echo"<script> alert('da');<script>";
$sql="INSERT INTO mesaje (Username,Message) VALUES ('$var1','$var2');";
mysqli_query($conn,$sql);
header("Location:Session.php");