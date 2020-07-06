<?php
session_start();
if (!isset($_SESSION['id']))
{
    header("Location: ../../../index.php");
}
include "../../autoloader/autoloader.php";
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Receive message</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
  <script src = "../../../js/chat/receiveMessage.js"></script>
</head>
<body>
<section>
<?php 
    $objChatController = new ChatController();
    $objUserController = new UserController();
    $msg = $objChatController->allMessager($idUser);
    $idUserConversation = $objUserController->getIdWithPseudo($_GET['chat']);
    var_dump($idUserConversation);
?>
    
    
    <?php
    
    
    // echo $idLastConversation[0]["id"] . "  <br>";
    // echo $idLastConversation[0]["content"] . "  <br>";
    // echo $idLastConversation[0]["receiver_id"] . "  <br>";
    // echo $idLastConversation[0]["sender_id"] . "  <br>";
   /* div de base faite par poulet
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
    /*
       $idLastConversation = [];
    foreach ($msg as $key => $value)
    {
        $i = 0;
        $count = 0;
        // echo $value["id"] . "  <br>";
        // echo $value["content"] . "  <br>";
        // echo $value["receiver_id"] . "  <br>";
        // echo $value["sender_id"] . "  <br>";
        $idconversation = $value["receiver_id"] ."-". $value["sender_id"];
        while($i !== count($idLastConversation))
        {
            
            if ($idconversation == $idLastConversation[$i]['id_conversation'] || strrev($idconversation) == $idLastConversation[$i]['id_conversation'])
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
       
        // echo $idLastConversation[$countConv]["id"] . "  <br>";
        // echo $idLastConversation[$countConv]["content"] . "  <br>";
        // echo $idLastConversation[$countConv]["receiver_id"] . " <br>";
        // echo $idLastConversation[$countConv]["sender_id"] . "  <br>";
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
        <a href='conversation.php?chat='".$conversation[0]['username'].">
                    <div class='msgRecu' id='msg'>
                        <div class='row'>
                            <div class='three columns'>
                                <img src='../../css/img/face.jpg' class='roundedImage'>
                            </div>
                            <div class='nine columns'>
                                <div>
                                    <span> ".$conversation[0]['fullname']." </span> <span style='float: right' > @".$conversation[0]['username']." </span> <br>
                                </div>
                                    <span> ".$conversation[0]['content']." </span>
                            </div>
                        </div>
                    </div>
                </a>
        ";
       //var_dump($conversation[0]);

        $countConv++;
    }
    */
?>
</section>
</body>
