<?php
session_start();
include "../../autoloader/autoloader.php";
$objValidatorController = new ValidatorController();
$objUserController = new UserController();
if(isset($_POST['data_send_connexion']) && !empty($_POST['data_send_connexion'])) // Si la connexion est réussi l'ajax retorune une requête POST['data_send_connexion']
{
  $pseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_connexion']['pseudo'])))), 1, -1);
  $idUser = $objUserController->getIdWithPseudo($pseudo);
  $_SESSION['id'] = $idUser;
}
else
{
  $objValidatorController->checkConnexion();
}
