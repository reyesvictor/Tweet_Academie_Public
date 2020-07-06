<?php 
session_start();
include "../../autoloader/autoloader.php";
$objValidatorController = new ValidatorController();
if(isset($_POST['newPassword']) && !empty($_POST['newPassword'])) 
{
    $idUser = intval($_SESSION['id'][0]['id']);
    $optionsHash = array(
        'salt' => 'vive le projet tweet_academy',
        'cost' => 11
    );
    $newPassword = hash('ripemd160', (substr(json_encode(htmlspecialchars(strip_tags(trim($_POST['newPassword'])))), 1, -1)));
    $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT, $optionsHash);
    $objUserController = new UserController(); 
    $objUserController->newPassword($newPasswordHashed, $idUser);
}
else
{
    $objValidatorController->checkPassword();
}
