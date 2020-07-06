<?php 

include "../../autoloader/autoloader.php";
if ($_POST['data_newMessage'])
{
    $content = $_POST['data_newMessage']['message'];
    $idSender = intval($_POST['data_newMessage']['idMember']);
    $pseudoReceiver = $_POST['data_newMessage']['receiver'];
    $objUserController = new UserController();
    $idReceiver = $objUserController->getIdWithPseudo($pseudoReceiver); 
    $objChatController = new ChatController();
    $objChatController->sendMessage($content, $idSender, $idReceiver[0]['id']);
}
