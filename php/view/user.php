<?php
session_start();
include "../classes/database/Dbh.class.php";
include "../classes/model/Tweet.class.php";
include "../classes/controller/TweetController.class.php";
if (!isset($_SESSION['id'])) {
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
    let user_id = '<?php echo intval($_SESSION['id'][0]['id']); ?>';
  </script>
  <script src="../../js/home.js"></script>
  <script src="../../js/myLibrary/script.js"></script>
  <script src="../../js/search/searchBar.js"></script>
  <script src="../../js/user.js"></script>
  <link rel="stylesheet" href="../../css/style/normalize.css">
  <link rel="stylesheet" href="../../css/style/skeleton.css">
  <link rel="stylesheet" href="../../css/style/user.css">
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

  <!-- COLONNE CENTRE -->
  <div class="six columns">
    <span id='user_profile_information'></span>
    <!-- Feed tabs -->
    <div class="feedtabs row">
      <div class="feedtabs__tweet three columns selected">
        <a href="#">Tweets</a>
      </div>
      <!-- <div class="feedtabs__tweet_with_replies three columns">
            <a href="#">Réponses</a>
          </div>
          <div class="feedtabs__medias three columns">
            <a href="#">Médias</a>
          </div> -->
      <div class="tabs__likes three columns">
        <a href="#">J'aime</a>
      </div>
    </div>

    <!-- Tweet part -->
    <div id="tweet">

    </div>
  </div>
  <?php
  $objTweetController = new TweetController();
  $showAllTweet = $objTweetController->showAllTweet();
  // echo '<pre>' , print_r($showAllTweet[0]) , '</pre>';
  // unset($objTweetController);
  ?>
  <?php
  // MONTRER LES RESULTATS DE RECHERCHE
  // $objTweetController = new TweetController();
  // $showTweetSearch = $objTweetController->showTweetSearch();
  // echo '<pre>' , print_r($showTweetSearch) , '</pre>'; //================utile search result=========================
  // unset($objTweetController);
  ?>
</body>

<?php
if (isset($_POST['content-tweet']) && !empty($_POST['content-tweet'])) {
  $newTweetContent = substr(json_encode(htmlspecialchars(strip_tags($_POST['content-tweet']))), 1, -1);
  // var_dump($newTweetContent);
  // echo '<pre>' , print_r($newTweetContent) , '</pre>';
  $objTweetController->createNewTweet($idUser, $newTweetContent);
}
?>

<?php
// --- Show Trending Tags
// echo '<pre>' , print_r($objTweetController->trendingTag()) , '</pre>'; //================ trending tags result=========================
unset($objTweetController);
// foreach ( $objTweetController->trendingTag() as $key => $value ) {
//     echo  'tagName : ' . $value['tagName'] . '<br>';
//     echo  'Nombre : ' . $value['Nombre'] . '<br>';
// }
?>