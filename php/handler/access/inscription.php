<?php 
include "../../autoloader/autoloader.php";
$objValidatorController = new ValidatorController();
$objUserController = new UserController();
if(isset($_POST["data_send_inscription"]) && !empty($_POST["data_send_inscription"])) // Si l'inscription est réussi l'ajax retorune une requête POST['data_send_inscription']
{
  // on sécurise les variables des données qu'on reçoit -- le substr pour retirer les guillemets
  $optionsHash = array(
    'salt' => 'vive le projet tweet_academy',
    'cost' => 11
  );
  $pseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['pseudo'])))), 1, -1);
  $email = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['email'])))), 1, -1);
  $name = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['name'])))), 1, -1);
  $date_birthday = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['date_birthday'])))), 1, -1);
  $location = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['location'])))), 1, -1);
  $password = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['password'])))), 1, -1));
  $passwordHashed = password_hash($password, PASSWORD_DEFAULT, $optionsHash);
  $passwordConfirmation = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_inscription']['passwordConfirmation'])))), 1, -1));
  $passwordConfirmationHashed = password_hash($passwordConfirmation, PASSWORD_DEFAULT, $optionsHash);
  $objUserController->createUser($pseudo, $email, $name,  $date_birthday, $location, $passwordConfirmationHashed); // ajout de l'user dans la db
  $idUser = $objUserController->getIdWithPseudo($pseudo);
  $_SESSION['id'] = $idUser;

  $password = hash('ripemd160', substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_inscription']['password'])))), 1, -1));
 
}
else
{
    $objValidatorController->checkInscription();
}