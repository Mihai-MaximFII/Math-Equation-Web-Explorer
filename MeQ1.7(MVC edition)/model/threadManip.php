<?php

class threadManip
{
    public function insertThread($User,$Title,$Category,$Content)
    {
        $sql = "INSERT INTO Threads (Username,Title,Category,Content,created_at,updated_at) VALUES (:Username, :Title,:Category, :Content, :created_at, :updated_at)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute ([
            'Username' => $User,
            'Title' => $Title,
            'Category' => $Category,
            'Content'=>$Content,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
       }

    public function getThreadByUser($User)
    {    
         $sql = "Select * From Threads where Username=:Username;";
         $cerere = BD::obtine_conexiune()->prepare($sql);
         $cerere->execute([
             'Username'=>$User
         ]);
         return $cerere->fetchAll();
    }
    public function deleteThreadByUser($User)
    {
        $sql = "Delete From Threads where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute([
            'Username'=>$User
        ]);
        return $cerere->fetchAll();
    }

}