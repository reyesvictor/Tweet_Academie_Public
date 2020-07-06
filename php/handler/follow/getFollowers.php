<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/User.class.php";
include "../../classes/controller/UserController.class.php";
if ( !isset($_POST["id_to_search"]) ) {
  header('Location: ../../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  $objUserController = new UserController();
  try {
    // var_dump($_POST);
    $list = $objUserController->followers($_POST["id_to_search"]); // une nouvelle methode a creer
    echo json_encode($list);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}