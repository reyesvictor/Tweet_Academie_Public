<?php

class Chat extends Dbh
{
    // -- Private execution
    private function executeAndReturn($sql, $value=null) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value]);
        $results = $stmt->fetchAll();
        return $results;
    }
    private function simpleExecute($sql, $value=null, $value2=null, $value3=null) 
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value, $value2, $value3]);
    }

    // --- GET INFORMATION IN DB 
    // pour recuperer tout les messages SELECT DISTINCT id from chat WHERE sender_id = 8 OR receiver_id = 8 ORDER BY date
    protected function setAllMessagerie($idMember)
    {
        $sql = "SELECT * from chat WHERE sender_id = $idMember OR receiver_id = $idMember ORDER BY date DESC";
        return $this->executeAndReturn($sql, $idMember);
    }
    protected function setAllConversation($idMember)
    {
        $sql = "SELECT * from chat WHERE sender_id = $idMember OR receiver_id = $idMember ";
        return $this->executeAndReturn($sql, $idMember);
    }
    protected function setAllUserInfoConversation($corresponding, $idTweet)
    {
        $sql = "SELECT user.fullname, user.username, chat.content from chat 
        LEFT JOIN user ON chat.$corresponding = user.id 
        WHERE chat.id = $idTweet";
        return $this->executeAndReturn($sql, $idTweet);
    }
    protected function setPersoConversation($corresponding, $idTweet)
    {
        $sql = "SELECT  chat.content chat.date from chat 
        LEFT JOIN user ON chat.$corresponding = user.id 
        WHERE chat.id = $idTweet";
        return $this->executeAndReturn($sql, $idTweet);
    }
    // --- SET INFORMATION IN DB
    protected function setSendMessage($content, $idSender, $idReceiver, $media = null)
    {
        $sql = "INSERT INTO chat (content, date, sender_id, receiver_id, media) VALUES (?, UTC_TIMESTAMP, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$content, $idSender, $idReceiver, $media = null]);
    } 
    // --- UPDATE INFORMATION IN DB 
    
}