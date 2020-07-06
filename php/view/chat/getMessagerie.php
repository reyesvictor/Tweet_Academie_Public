<?php 
    $objChatController = new ChatController();
    $msg = $objChatController-> allMessagerie($idUser);
    $idLastConversation = [];
    foreach ($msg as $key => $value)
    {
        $i = 0;
        $count = 0;
        $idconversation = $value["receiver_id"] ."-". $value["sender_id"];
        $idconversationReverse = $value["sender_id"]."-".$value["receiver_id"];
        while($i !== count($idLastConversation))
        {
            
            if ($idconversation == $idLastConversation[$i]['id_conversation'] || $idconversationReverse == $idLastConversation[$i]['id_conversation'])
            {
                $count++;
            }
           
            $i++;
        }
        if ($count == 0)
        {
            $value['id_conversation'] = $idconversation;
            $idLastConversation[] = $value;
        }
    }
    $countConv = 0;
    while ($countConv !== count($idLastConversation))
    {   
        echo "<br>";
        if ($idLastConversation[$countConv]["receiver_id"] !== strval($idUser))
        {
            $conversation = $objChatController->allUserInfoConversation("receiver_id", $idLastConversation[$countConv]["id"]);
            
        }
        else
        {
            $conversation = $objChatController->allUserInfoConversation("sender_id", $idLastConversation[$countConv]["id"]);
        }
        echo "
        <a href='conversation.php?chat=".$conversation[0]['username']."'>
                    <div class='msgRecu' id='msg'>
                        <div class='row'>
                            <div class='two columns'>
                                <img src='../../../css/img/pp/{$value["receiver_id"]}.jpg' class='roundedImage msg-profil-img'>
                            </div>
                            <div class='ten columns'>
                                <div>
                                    <span class='msg-fullname'> ".$conversation[0]['fullname']." </span> <span class='msg-username color-theme' > @".$conversation[0]['username']." </span> <br>
                                </div>
                                    <span class='msg-content'> ".$conversation[0]['content']." </span>
                            </div>
                        </div>
                    </div>
                </a>
        ";
       //var_dump($conversation[0]);

        $countConv++;
    }

    // echo $idLastConversation[0]["id"] . "  <br>";
    // echo $idLastConversation[0]["content"] . "  <br>";
    // echo $idLastConversation[0]["receiver_id"] . "  <br>";
    // echo $idLastConversation[0]["sender_id"] . "  <br>";
   /*
    <a href="conversation.php">
                    <div class="msgRecu" id="msg">
                        <div class="row">
                            <div class="three columns">
                                <img src="../../css/img/face.jpg" class="roundedImage">
                            </div>
                            <div class="nine columns">

                            </div>
                        </div>
                    </div>
                </a>
   */

?>