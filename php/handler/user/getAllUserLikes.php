<?php 
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new TweetController();
  try {
    $allTweets = $objUserController->userTweetLiked($_POST["data"]);
    echo json_encode($allTweets);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}