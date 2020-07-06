<?php
session_start();
include "../classes/database/Dbh.class.php";
include "../classes/model/Tweet.class.php";
include "../classes/controller/TweetController.class.php";
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
    <script type='text/javascript' src='../../js/jquery.uncompressed.3.4.1.js'></script>
    <script type="text/javascript">
       let user_id = '<?php echo intval($_SESSION['id'][0]['id']);?>';
    </script>
    <script src = "../../js/home.js"></script>
    <!-- <script src = "../../js/user.js"></script> -->
    <script src = "../../js/myLibrary/script.js"></script>
    <script src = "../../js/search/searchBar.js"></script>
    <link rel="stylesheet" href="../../css/style/normalize.css">
    <link rel="stylesheet" href="../../css/style/skeleton.css">
    <!-- supprimer les css non necessaire -->
    <link rel="stylesheet" href="../../css/style/user.css">
    <link rel="stylesheet" href="../../css/style/home.css">
</head>
<body class="body--home">
<header>

</header>

<section>
  <form id='search-content-form'> 
    <input type='text' id='search-content' placeholder='Search'>
    <input class="button" type="submit" id='search-submit' value="Search">
  </form>
  <form id='new-content-form'>
    <input type='text' id='newTweet-content' placeholder="What's up ?">
        <input class="button" type="submit" id='newTweet-submit' value="Tweeter">
      </form>
    </section>

    <h1>Importer page home</h1>

    <div id="tweet">

    </div>
  
    
    <?php 
    $objTweetController = new TweetController();
    $showAllTweet = $objTweetController->showAllTweet();
    if(isset($_POST['content-tweet']) && !empty($_POST['content-tweet']))
    {
        $newTweetContent = substr(json_encode(htmlspecialchars(strip_tags($_POST['content-tweet']))), 1, -1);
        $objTweetController->createNewTweet($idUser, $newTweetContent);
    }
    unset($objTweetController);
    ?>

</body>