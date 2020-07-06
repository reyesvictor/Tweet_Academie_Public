<?php
if (!isset($_POST["data"])) {
  header('Content-Type: application/json');

  header('Location: ../../'); //on sort de view et on sort de php pour aller sur index.php
  return false;
} else {
  include "../../autoloader/autoloader.php";
  $objUserController = new TweetController();
  try {
    $result = $objUserController->allTweetsAndRT();
    $temp = json_encode(utf8ize($result));
    echo $temp;
  } catch (\Throwable $th) {
    echo json_encode($th);
  }
}

function utf8ize($d)
{
  if (is_array($d)) {
    foreach ($d as $k => $v) {
      $d[$k] = utf8ize($v);
    }
  } else if (is_string($d)) {
    return utf8_encode($d);
  }
  return $d;
}
