<?php
session_start(); 
if (!isset($_SESSION['id']))
{
    header("Location: ../index.php");   
}
include "../../autoloader/autoloader.php";
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 
$objUserController = new UserController;
$pseudoUser = $objUserController->getPseudoWithId($idUser); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Changer de nom d'utilisateur</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
    <script src = "../../../js/settings/pseudo.js"></script>
    <link rel="stylesheet" href="../../../css/style/normalize.css">
    <link rel="stylesheet" href="../../../css/style/skeleton.css">
</head>
<body class="body--pseudo">
<header>

</header>
<section>
    <form id="new-pseudo-form">
        <input type="text" name="pseudo" id="pseudo" value='<?php echo $pseudoUser[0]['username'] ?>'>
        <input type="submit" value="Confirmer" id="new-pseudo-submit">
    </form>
</section>
</body>

<?php 
if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"]))
{
    $newPseudo= substr(json_encode(strip_tags(trim($_POST["pseudo"]))), 1, -1);
    $objUserController = new UserController(); 
    $objUserController->newPseudo($newPseudo, $idUser);
}
?>