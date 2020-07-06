<?php
session_start();
include "../../classes/database/Dbh.class.php";
include "../../classes/model/Tweet.class.php";
include "../../classes/controller/TweetController.class.php";
if (!isset($_SESSION['id'])) {
  header("Location: ../../../index.php");
}
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <title>Followers | Tweet Academy</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
  <script type="text/javascript">
    let user_id = '<?php echo intval($_SESSION['id'][0]['id']); ?>';
  </script>
  <script type='text/javascript' src="../../../js/myLibrary/script.js"></script>
  <script type='text/javascript' src="../../../js/user/followers.js"></script>
  <script type='text/javascript' src="../../../js/search/searchUser.js"></script>
  <!-- <script src = "../../js/index.js"></script> -->
  <script type='text/javascript' src="../../../js/theme.js"></script>
  <link rel="stylesheet" href="../../../css/style/user.css">
  <link rel="stylesheet" href="../../../css/style/follow.css">
  <link rel="stylesheet" href="../../../css/style/normalize.css">
  <link rel="stylesheet" href="../../../css/style/skeleton.css">
  <link rel="icon" type="image/png" href="../../../css/img/favicon.png">

</head>
<body>
  <div class="container" id="container">
    <!-- colonne gauche menu -->
    <div class="three columns test" id="menu-big-div">
      <?php include '../includes/left_menu.php'; ?>
    </div>


    <!-- COLONNE CENTRE -->
    <div class="six columns" id='container'>
      
      <!-- Feed tabs -->
      <div class="feedtabs row" id="tabs">
        <div class="feedtabs__following six columns" id="tabs_following-div">
          <a href="following.php" id="tabs_following">Following</a>
        </div>
        <div class="feedtabs__follower six columns selected" id="tabs_follower-div">
          <a href="followers.php" id="tabs_follower" class='color-theme'>Followers</a>
        </div>
      </div>
      <div class="all-follow row">

      </div>

    </div>

    <!-- COLONNE DROITE -->
    <div class="three columns sea" id="search-col-div">
      <div class="search-col" id="search-col">
        <input type="search" placeholder="Recherche twitter" id="search-input">
      </div>
    </div>

  </div>


</body>
</html>