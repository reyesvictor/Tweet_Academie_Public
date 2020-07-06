<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/User.class.php";
include "../../classes/controller/UserController.class.php";
$objUserController = new UserController();
$objUserController->modificationPassword();