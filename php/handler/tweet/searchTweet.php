<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
if ( !isset($_POST["data_newSearch"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new TweetController();
  $result = $objUserController->searchTweet($_POST["data_newSearch"]['content-search']);
  echo json_encode($result);
}