<?php

class ChatController extends Chat 

{
    // --- GET INFORMATION IN DB
    public function allMessagerie($idMember)
    {
        $results = $this->setAllMessagerie($idMember);
        return $results;
    }
    public function allConversation($idMember)
    {
        $results = $this->setAllConversation($idMember);
        return $results;
    }
    public function allUserInfoConversation($corresponding, $idTweet)
    {
        $results = $this->setAllUserInfoConversation($corresponding, $idTweet);
        return $results;
    }
    // --- SET INFORMATION IN DB
    public function sendMessage($content, $idSender, $idReceiver, $media = null)
    {
       $this->setSendMessage($content, $idSender, $idReceiver, $media = null);
    }
    // --- UPDATE INFORMATION IN DB 
}