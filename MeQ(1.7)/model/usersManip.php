<?php
include 'connectToDatabase.php';
class usersManip 
{
   public function insertUser($utilizator,$parola,$email)
   {
    $sql = "INSERT INTO Accounts (Username,Pass,Email,updated_at) VALUES (:Username, :Pass, :Email, :updated_at)";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    return $cerere -> execute (array(':Username' => $utilizator,':Pass' => $parola,':Email' => $email,':updated_at' => date('Y-m-d H:i:s')));
   }
   public function deleteUser($utilizator)
   {
    $sql = "Delete From Accounts where Username=:Username;";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute(array(':Username'=>$utilizator));
    return $cerere->fetchAll();
   }
   public function verifyUser($username,$password)
   {
    $sql = "Select count(*) from Accounts where Username=:Username and Pass=:Password;";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute(array(':Username'=>$username,':Password'=>$password));
    return $cerere->fetch();
   }
}
?>