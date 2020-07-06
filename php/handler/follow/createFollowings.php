<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/User.class.php";
include "../../classes/controller/UserController.class.php";
if ( !isset($_POST["user_id"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new UserController();
  try {
    $list = $objUserController->createFollowings($_POST["user_id"], $_POST["id_abo"]);
    echo json_encode($list);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}