<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new TweetController();
  try {
    $objUserController->userPinTweet($_POST["data"]);
    echo json_encode("The tweet has been unpinned.");
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}