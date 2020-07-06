<?php 
if ( !isset($_POST["data_newSearch"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new TweetController();
  $result = $objUserController->searchTweet($_POST["data_newSearch"]['content-search']);
  echo json_encode($result);
}