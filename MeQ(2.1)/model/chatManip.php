<?php

include_once 'connectToDatabase.php';
class chatManip
{
    public function insertMessage($From,$Content)
    {
        $sql = "INSERT INTO Chat (Frm,Content,updated_at) VALUES (:FRM,:CONTENT,:UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute (array(
            ':FRM' => $From,
            ':CONTENT' =>$Content,
            ':UPDATED_AT'=>date('Y-m-d H:i:s')
        ));
    }
    public function getAllMessages()
    {
        $sql="SELECT * FROM Chat ORDER BY ID ASC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        return $cerere->fetchAll();
    }

}