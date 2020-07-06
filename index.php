<?php
session_start();
include "php/autoloader/autoloader.php";
if (isset($_SESSION['id'])) {
  header("Location: php/view/home/home.php");
}
?>

<!-- INSCRIPTION -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <title>Tweet Academy</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type='text/javascript' src='js/jquery.uncompressed.3.4.1.js'></script>
  <script type='text/javascript' src="js/myLibrary/script.js"></script>
  <script type='text/javascript' src="js/index.js"></script>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/style/index.css">
  <link rel="stylesheet" href="css/style/normalize.css">
  <link rel="stylesheet" href="css/style/skeleton.css">
  <link rel="icon" type="image/png" href="css/img/favicon.png">

</head>

<body>
  <h2 class='sm-hide color-theme' id='menu-title'>Tweet<br>Academy</h2>
  <div class="panel">

  </div>
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 25%">
        <h4>Connexion</h4>
        <form id='connexion-form'>
          <input type="text" id='connexion-pseudo' placeholder="Pseudo">
          <input type="password" id='connexion-password' placeholder="Mot de passe">
          <!-- <input type="submit" value="Se connecter"> -->
          <input class="button-primary" type="submit" id='connexion-submit' value="Se connecter">
        </form>
        <a href="#">Mot de passe oublié ?</a><br><br>
        <button type="button" class="button" id="switch_reg">S'inscrire</button>
      </div>
      <div class="one-half column" id='inscription-div' style="margin-top: 25%">
        <h4 id='inscription-h4'>Inscription</h4>
        <form id='inscription-form'>
          <input type="text" id='inscription-pseudo' placeholder="Pseudo"><br>
          <input type="email" id='inscription-email' size="35" placeholder="E-mail"><br>
          <input type="text" id='inscription-name' placeholder="Nom"><br>
          <input type="date" id='inscription-date_birthday'><br>
          <input type="text" id='inscription-location' placeholder="Localisation"><br>
          <input type="password" id='inscription-password' size="25" placeholder="Mot de passe"><br>
          <input type="password" id='inscription-passwordConfirmation' size="25" placeholder="Confirmation mot de passe"><br>
          <!-- <input type="text" id='isncription-bio'size="40" placeholder="Bio"><br> -->
          <input class="button-primary" type="submit" id='inscription-submit' value="S'inscrire">
        </form>
        <a href="#" id="switch_reg_right">Déjà inscrit ?</a>
      </div>
    </div>
    <!-- <button href="#">S'inscrire</button> -->
  </div>
</body>

</html>
<?php
//include "../autoloader/autoloader.php";
include "php/classes/database/Dbh.class.php";
include "php/classes/model/User.class.php";
include "php/classes/controller/UserController.class.php";
$objUserController = new UserController();


if (isset($_POST["data_send_inscription"]) && !empty($_POST["data_send_inscription"])) // Si l'inscription est réussi l'ajax retorune une requête POST['data_send_inscription']
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

if (isset($_POST['data_send_connexion']) && !empty($_POST['data_send_connexion'])) // Si la connexion est réussi l'ajax retorune une requête POST['data_send_connexion']
{
  $pseudo = substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['data_send_connexion']['pseudo'])))), 1, -1);
  $idUser = $objUserController->getIdWithPseudo($pseudo);
  $_SESSION['id'] = $idUser;
}
