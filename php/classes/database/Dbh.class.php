<?php
// CONNECT TO THE DATABASE HOST
class Dbh
{
    // private $host = "localhost";
    // private $user = "root";
    // private $pwd = "";
    // private $dbName = "tweet_academie";

    //CONNEXION TO THE DATABASE MY_MEETIC
    protected function connect()
    {
        $host = "eu-cdbr-west-03.cleardb.net";
        $user = "b120e4117d9627";
        $pwd = "c5e56f74";
        $dbName = "heroku_3a2e0501fb5e20c";

        $dsn = 'mysql:host=' . $host . ';port=3306;dbname=' . $dbName;
        $pdo = new PDO($dsn,  $user,  $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
