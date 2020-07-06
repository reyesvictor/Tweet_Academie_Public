<?php 
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objTweetController = new TweetController();
  try {
    // if (isset($_POST['content-tweet']) && !empty($_POST['content-tweet'])) {
      $newTweetContent = substr(json_encode(htmlspecialchars(strip_tags($_POST['data']['content-tweet']))), 1, -1);
      $objTweetController->createNewTweet($_POST['idUser'], $newTweetContent);
    // }dd
    unset($objTweetController);
    echo json_encode('Tweet Enregistré Dans La BDD.');
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}

?>