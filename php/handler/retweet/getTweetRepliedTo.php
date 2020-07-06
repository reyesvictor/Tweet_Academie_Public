<?php 
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new TweetController();
  try {
    $tweet = $objUserController->TweetRepliedTo($_POST["data"]);
    echo json_encode($tweet[0]);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}