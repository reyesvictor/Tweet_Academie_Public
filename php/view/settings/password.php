<?php
session_start();
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
if (!isset($_SESSION['id']))
{
    header("Location: ../../index.php");
}
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
    <script src = "../../../js/password.js"></script>
    <link rel="stylesheet" href="../../../css/style/normalize.css">
    <link rel="stylesheet" href="../../../css/style/skeleton.css">
</head>
<body class="body--home">
<header>

</header>
<section>
    <form id="new-password-form">
        <input type="password" name="password" id="password" placeholder='Mot de passe actuel'>
        <input type="password" name="new-password" id="new-password" placeholder='Nouveau mot de passe'>
        <input type="password" name="new-passwordConfirmation" id="new-passwordConfirmation" placeholder='Confirmer mot de passe'>
        <input type='hidden' id='idMember' value="<?php echo $idUser;?>">
        <input type="submit" value="Confirmer" id="new-password-submit">
    </form>
</section>
</body>

<?php 
if(isset($_POST) && !empty($_POST))
{
    var_dump($_POST);
}
?>