<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
if ( !isset($_POST["user_id"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new TweetController();
  try {
    $allTweets = $objUserController->userTweetsAndRT($_POST["user_id"]);
    echo json_encode($allTweets);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}