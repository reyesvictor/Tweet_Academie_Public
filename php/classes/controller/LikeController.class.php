<?php

class LikeController extends Like
{
    // --- GET INFORMATION IN DB 
    public function likeInfo($idMembre, $idTweet)
    {
        $results = $this->setLikeInfo($idMembre, $idTweet);
        if ($results == null || empty($results)) {
            return 0;
        } else {
            return 1;
        }
    }
    public function likeId($idMembre, $idTweet)
    {
        $results = $this->setLikeInfo($idMembre, $idTweet);
        return $results[0]['id'];
    }
    // --- SET INFORMATION IN DB
    public function sendLike($idMembre, $idTweet)
    {
        $this->setSendLike($idMembre, $idTweet);
    }
    // --- UPDATE INFORMATION IN DB 
    public function deleteLike($idTweet)
    {
        $this->setDeleteLIke($idTweet);
    }
}
