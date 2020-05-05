<?php


class replyManip
{
    public function insertReply($USER_ID,$THREAD_ID,$CONTENT,$IMAGE_NAME)
    {
        $sql = "INSERT INTO Replies (USER_ID,THREAD_ID,CONTENT,IMAGE_NAME,UPDATED_AT) VALUES (:USER_ID, :THREAD_ID,:CONTENT,:IMAGE_NAME, :UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':USER_ID' => $USER_ID,
            ':THREAD_ID' => $THREAD_ID,
            ':CONTENT' =>$CONTENT,
            ':IMAGE_NAME' => $IMAGE_NAME,
            ':UPDATED_AT' => date('Y-m-d H:i:s')
        ));
    }
    public function getAllReplies()
    {
        $sql="Select * from Replies";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
}