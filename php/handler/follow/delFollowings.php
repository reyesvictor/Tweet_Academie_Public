<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/User.class.php";
include "../../classes/controller/UserController.class.php";
if ( !isset($_POST["id_sub"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new UserController();
  try {
    $list = $objUserController->delFollowings($_POST["id_to_search"], $_POST["id_sub"]); // une nouvelle methode a creer
    echo json_encode($list);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}