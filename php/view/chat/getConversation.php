<?php 
    $objChatController = new ChatController();
    $objUserController = new UserController();
    $msg = $objChatController->allConversation($idUser);
    $getidUserConversation = $objUserController->getIdWithPseudo($_GET['chat']); // $getidUserConversation[0]['id'];
    if(isset($getidUserConversation[0]['id']))
    {
        $idUserConversation = $getidUserConversation[0]['id'];
    }
    else
    {
      echo "erreur utilisateur n'existe pas";
      return;
    }
   
    foreach ($msg as $key => $value)
    {
        //echo $value['content']."<br>";
        if($value["receiver_id"] == $idUser && $value["sender_id"] == $idUserConversation)
        {
            echo "
            <div class='msgDestinataire'>
                <div class='row'>
                    
                    <div class='ten columns'>
                       <span class='content-msg-mp content-dest'>".$value['content']."</span> <br>
                       <span class='date-msg-mp content-dest'>".$value['date']."</span>
                   </div>
                   <div class='two columns'>
                        <img src='../../../css/img/pp/{$value["sender_id"]}.jpg' class='roundedImage msg-profil-img img-mp'>
                    </div>
                </div>
            </div>";
        }
        elseif ($value["receiver_id"] == $idUserConversation && $value["sender_id"] == $idUser)
        {
            echo"
            <div class='msgEnvoyer'>
                <div class='row'>
                    <div class='two columns'>

                    </div>
                    <div class='ten columns'>
                        <span class='content-msg-mp content-env'>".$value['content']."</span> <br>
                        <span class='date-msg-mp content-env'>".$value['date']."</span>
                    </div>
                </div>
            </div>";
        }
        else
        {
            //echo 'ok';
        }
         // echo $value["id"] . "  <br>";
        // echo $value["content"] . "  <br>";
        // echo $value["receiver_id"] . "  <br>";
        // echo $value["sender_id"] . "  <br>";
    }
?>