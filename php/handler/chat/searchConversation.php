<?php 

include "../../autoloader/autoloader.php";
if ($_POST['data_newConversation'])
{
    $pseudoUserToSearch = $_POST['data_newConversation']['pseudoUserToSearch'];
}