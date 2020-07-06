<?php 
if ( !isset($_POST["data"]) ) {
  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new UserController();
  try {
    $result = $objUserController->userInf($_POST["data"]);
    echo json_encode($result[0]);
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}