<?php 
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new TweetController();
  try {
    $objUserController->userPinTweet($_POST["data"]);
    echo json_encode("The tweet has been pinned.");
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}