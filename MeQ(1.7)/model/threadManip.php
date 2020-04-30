<?php
ini_set('display_errors', 1);
class threadManip
{
    public function insertThread($User,$Title,$Category,$Content)
    {   
        $sql = "INSERT INTO Threads (Username,Title,Category,Content,updated_at) VALUES (:Username, :Title,:Category, :Content, :updated_at)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $User,
            ':Title' => $Title,
            ':Category' => $Category,
            ':Content'=>$Content,
            ':updated_at' => date('Y-m-d H:i:s')
        ));
       }

    public function getThreadByUser($User)
    {    
         $sql = "Select * From Threads where Username=:Username;";
         $cerere = BD::obtine_conexiune()->prepare($sql);
         $cerere->execute(array(
             ':Username'=>$User
         ));
         return $cerere->fetchAll();
    }
    public function deleteThreadByUser($User)
    {
        $sql = "Delete From Threads where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$User
        ));
        return $cerere->fetchAll();
    }
    public function getAllThreads()
    {
        $sql="Select * from Threads";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getThreadIdByUser($Username)
   {
        $sql="Select ID from Threads where Username=:Username order by ID desc limit 1;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Username'=>$Username));
        return $cerere->fetchAll();
   }

}