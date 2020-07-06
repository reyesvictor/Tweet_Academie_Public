<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../../../index.php");
}
include "../../autoloader/autoloader.php";
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <title>Twitter Homepage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
  <script type='text/javascript' src="../../../js/search/searchBar.js"></script>
  <script type='text/javascript' src="../../../js/search/searchUser.js"></script>
  <script type='text/javascript' src="../../../js/myLibrary/script.js"></script>
  <script type='text/javascript' src="../../../js/tweet/tweet.js"></script>
  <script type='text/javascript' src="../../../js/theme.js"></script>
  <script type='text/javascript' src="../../../js/home.js"></script>
  <script type='text/javascript' src="../../../js/tweet/trendingTag.js"></script>
  <script type='text/javascript' src="../../../js/like.js"></script>
  <script type="text/javascript">
    let user_id = '<?php echo intval($_SESSION['id'][0]['id']); ?>';
    localStorage.setItem('username', user_id); //uniquement sur home.php
    // localStorage.removeItem('user_id_follow');
</script>
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/normalize.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/skeleton.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/home.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/user.css">
  <link rel="stylesheet" type="text/css" href="../../../css/style/menu.css">
  <link rel="icon" type="image/png" href="../../../css/img/favicon.png">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="three columns">
        <!-- menu -->
        <?php include '../includes/left_menu.php'; ?>
      </div>
      <div class="six columns">
        <?php include '../includes/up_tweet_div.php'; ?>
        <div>
          <!-- Results -->
          <div id="tweet">
          </div>
        </div>
      </div>

      <?php include '../includes/right_menu.php'; ?>
    </div>
  </div>

</body>

</html>