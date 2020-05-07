<?php
ini_set('display_errors', 1);
include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");
class threadManip
{
    public function insertThread($User,$Title,$Category,$Content)
    {   
        $sql = "INSERT INTO Threads (Username,Title,Category,Content,updated_at,Relevance) VALUES (:Username, :Title,:Category, :Content, :updated_at,:Relevance)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $User,
            ':Title' => $Title,
            ':Category' => $Category,
            ':Content'=>$Content,
            ':updated_at' => date('Y-m-d H:i:s'),
            ':Relevance'=>0
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

    }
    public function deleteThreadById($Id)
    {
        $sql = "Delete From Threads where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$Id
        ));

    }
    public function getRelevance($ID)
    {
        $sql = "Select Relevance from Threads where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }
    public function setRelevance($ID,$Relevance)
    {
        $sql = "UPDATE Threads SET Relevance=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($Relevance+1,$ID));
    }
    public function getAllThreads()
    {
        $sql="Select * from Threads order by Relevance desc";
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
    public function getUserById($ID)
    {
        $sql = "Select Username from Accounts where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }

}