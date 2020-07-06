<?php

class Like extends Dbh
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
    protected function setLikeInfo($idMembre, $idTweet)
    {
        $sql = "SELECT id from likes WHERE user_id = $idMembre AND tweet_id = $idTweet";
        return $this->executeAndReturn($sql, $idMembre);
    }
    // --- SET INFORMATION IN DB
    protected function setSendLike($idMembre, $idTweet)
    {
        $sql = "INSERT INTO likes (user_id, tweet_id) VALUES (?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$idMembre, $idTweet]);
    } 
    // --- UPDATE INFORMATION IN DB 
    protected function setDeleteLike($idTweet)
    {
        $sql = "DELETE FROM `likes` WHERE `likes`.`id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$idTweet]);

    }
}