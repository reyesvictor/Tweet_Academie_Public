<?php 
session_start();
include "../../autoloader/autoloader.php";
$objUserController = new ValidatorController();
$objUserController->checkPseudo();
if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
    $idUser = intval($_SESSION['id'][0]['id']);
    $newPseudo = substr(json_encode(strip_tags(trim($_POST["pseudo"]))), 1, -1);
    $objUserController = new UserController();
    $objUserController->newPseudo($newPseudo, $idUser);
}