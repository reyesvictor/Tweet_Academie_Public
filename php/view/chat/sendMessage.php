<?php
// session_start();
// include "../autoloader/autoloader.php";
// if (!isset($_SESSION['id']))
// {
//     header("Location: ../index.php");
// }
// $idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 


// <!DOCTYPE html>
// <html lang="en">
// <head>
//   <meta charset="utf-8">
//   <title>Send message</title>
//   <meta name="description" content="">
//   <meta name="author" content="">
//   <meta name="viewport" content="width=device-width, initial-scale=1">  
//   <script type='text/javascript' src='../../js/jquery.uncompressed.3.4.1.js'></script>
//   <script src = "../../js/sendMessage.js"></script>
//   <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
//   <link rel="stylesheet" href="css/style/index.css">
//   <link rel="stylesheet" href="css/style/normalize.css">
//   <link rel="stylesheet" href="css/style/skeleton.css">
//   <link rel="icon" type="image/png" href="images/favicon.png">
// </head>
// <body>
// <section>
// </section>
// </body>
?>
    <form id="new-sendMessage-form">
        <input type="text" name="sendMessage" id="sendMessage" placeholder='Message'>
        <input type='hidden' id='idUser' value="<?php echo $idUser?>">
        <input type='hidden' id='pseudoReceiver' 
        value="<?php 
        $objUserController = new UserController();
        $verifPseudo = $objUserController->verifPseudoUnique($_GET['chat']);
        if ($verifPseudo !== true)
        {   
            echo $_GET['chat'];
        }
        else
        {
            echo "undefined user";
        } 
        ?>">
        <input class="btn-color-theme-primary" type="submit" value="Confirmer" id="new-sendMessage-submit">
    </form>
