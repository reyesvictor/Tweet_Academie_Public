<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../../../index.php");
}
include "../../autoloader/autoloader.php";
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My profile | Tweet Academy</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
  <script type='text/javascript'>
    let user_id = '<?php echo intval($_SESSION['id'][0]['id']); ?>';
  </script>
  <script type='text/javascript' src="../../../js/myLibrary/script.js"></script>
  <script type='text/javascript' src="../../../js/search/searchBar.js"></script>
  <script type='text/javascript' src="../../../js/search/searchUser.js"></script>
  <script type='text/javascript' src="../../../js/user.js"></script>
  <script type='text/javascript' src="../../../js/theme.js"></script>
  <script type='text/javascript' src="../../../js/tweet/tweet.js"></script>
  <script type='text/javascript' src="../../../js/tweet/trendingTag.js"></script>
  <script type='text/javascript' src="../../../js/like.js"></script>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/my_user.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/user.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/normalize.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/skeleton.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/menu.css">
  <link rel="icon" type="image/png" href="../../../css/img/favicon.png">
</head>

<body>
  <div class="container">

    <!-- colonne gauche menu -->
    <div class="three columns test" id="menu-big-div">
      <?php include '../includes/left_menu.php'; ?>
    </div>
    <!-- COLONNE CENTRE -->
    <div class="six columns">
      <?php include '../includes/up_tweet_div.php'; ?>

      <!-- User Profile Information -->
      <span id='user_profile_information'></span>

      <!-- Feed tabs
      <div class="feedtabs row" id='feedtab_user'>
        <div class="feedtabs__tweet three columns selected">
          <a class='color-theme' href="#">Tweets</a>
        </div>
        <div class="feedtabs__tweet_with_replies three columns">
          <a href="#">Réponses</a>
        </div>
        <div class="feedtabs__medias three columns">
          <a href="#">Médias</a>
        </div>
        <div class="tabs__likes three columns">
          <a href="#">J'aime</a>
        </div>
      </div> -->
      <!-- Feed tabs -->
      <div class="feedtabs row" id='feedtab_user'>
        <div class="feedtabstweet three columns selected">
          <a class='color-theme' href="user.php">Tweets</a>
        </div>
        <!-- <div class="feedtabstweet_with_replies three columns">
          <a href="#">Réponses</a>
        </div>
        <div class="feedtabsmedias three columns">
          <a href="#">Médias</a>
        </div> -->
        <div class="tabslikes three columns">
          <a href="like.php">Likes</a>
        </div>
      </div>

      <!-- Tweet part -->
      <div id="tweet"></div>
    </div>
    <?php include '../includes/right_menu.php'; ?>
  </div>


</body>

</html>