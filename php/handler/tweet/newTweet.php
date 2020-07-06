<?php 
//include "../autoloader/autoloader.php";
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
$objUserController = new TweetController();
$objUserController->newTweetVerification();