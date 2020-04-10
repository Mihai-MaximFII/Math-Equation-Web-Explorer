<?php
include 'connectToDatabase.php';
class usersManip 
{
   public function insertUser($utilizator,$parola,$email)
   {
    $sql = "INSERT INTO Accounts (Username,Pass,Email,created_at,updated_at) VALUES (:Username, :Pass, :Email, :created_at, :updated_at)";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    return $cerere -> execute ([
        'Username' => $utilizator,
        'Pass' => $parola,
        'Email' => $email,
        'updated_at' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s')
    ]);
   }
   public function deleteUser($utilizator)
   {
    $sql = "Delete From Accounts where Username=:Username;";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute([
        'Username'=>$utilizator
    ]);
    return $cerere->fetchAll();
   }
}