<?php 
if ( !isset($_POST["data"]) && $_POST["data"] == 'trending_tag' ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objTweetController = new TweetController();
  try {
    $result = $objTweetController->trendingTag();
    echo json_encode($result);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}
