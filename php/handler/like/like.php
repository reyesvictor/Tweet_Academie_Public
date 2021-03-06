<?php
session_start();
include "../../autoloader/autoloader.php";
$objLikeController = new LikeController();
if (isset($_POST['data_like']) && !empty($_POST['data_like'])) {
  try {
    $idUser = intval($_SESSION['id'][0]['id']);
    $idTweet = intval($_POST['data_like']);
    $infotweet = $objLikeController->likeInfo($idUser, $idTweet);
    if ($infotweet == 0) {
      $objLikeController->sendLike($idUser, $idTweet);
      echo json_encode("Tweet liked. Your favourites are visible in your account.");
    } else {
      $idLikedTweet = $objLikeController->likeId($idUser, $idTweet);
      $objLikeController->deleteLike($idLikedTweet);
      echo json_encode("Tweet unliked. It has been deleted from your favourites.");
    }
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}
