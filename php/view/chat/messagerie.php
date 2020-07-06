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
    <meta charset="utf-8" />
    <title>Twitter Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
    <script type="text/javascript">
        let user_id = '<?php echo intval($_SESSION['id'][0]['id']); ?>';
    </script>
    <script type='text/javascript' src="../../../js/home.js"></script>
    <script type='text/javascript' src="../../../js/chat/messagerie.js"></script>
    <script type='text/javascript' src="../../../js/myLibrary/script.js"></script>
    <script type='text/javascript' src="../../../js/search/searchBar.js"></script>
    <script type='text/javascript' src="../../../js/theme.js"></script>
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/normalize.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/skeleton.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/home.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/user.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/menu.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style/messagerie.css">
    <link rel="icon" type="image/png" href="../../../css/img/favicon.png">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="three columns">
                <!-- menu -->
                <?php include '../includes/left_menu.php'; ?>
            </div>

            <div class="four columns">
                <div class="msgRecu" id="newMsg">
                    <div id="message">
                        <strong>Messages</strong>
                        <svg class="logo-msg" viewBox="0 0 20 20">

                            <path d="M19.291,3.026c0.002-0.15-0.053-0.301-0.167-0.415c-0.122-0.122-0.286-0.172-0.444-0.161H1.196
								c-0.16-0.011-0.322,0.039-0.444,0.161C0.637,2.725,0.583,2.875,0.585,3.026c0,0.003-0.002,0.006-0.002,0.009v14.032
								c0,0.322,0.262,0.584,0.585,0.584h17.54c0.322,0,0.584-0.262,0.584-0.584V3.035C19.292,3.032,19.291,3.029,19.291,3.026z
								 M17.147,3.619l-7.21,6.251L2.728,3.619H17.147z M18.122,15.896c0,0.323-0.261,0.584-0.584,0.584H2.337
								c-0.323,0-0.585-0.261-0.585-0.584V4.292l7.732,6.704c0.013,0.017,0.019,0.035,0.034,0.052c0.115,0.114,0.268,0.169,0.419,0.166
								c0.151,0.003,0.304-0.052,0.419-0.166c0.015-0.017,0.021-0.035,0.034-0.052l7.731-6.704V15.896z"></path>
                        </svg>

                        </svg><a href="conversation.php"></a></li>
                    </div>
                </div>
                <div class="msgRecu">
                    <div id="demandeDeMsg">
                        <strong>Messages Requests</strong>
                        <svg class="logo-msg" viewBox="0 0 20 20">
                            <path d="M12.522,10.4l-3.559,3.562c-0.172,0.173-0.451,0.176-0.625,0c-0.173-0.173-0.173-0.451,0-0.624l3.248-3.25L8.161,6.662c-0.173-0.173-0.173-0.452,0-0.624c0.172-0.175,0.451-0.175,0.624,0l3.738,3.736C12.695,9.947,12.695,10.228,12.522,10.4 M18.406,10c0,4.644-3.764,8.406-8.406,8.406c-4.644,0-8.406-3.763-8.406-8.406S5.356,1.594,10,1.594C14.643,1.594,18.406,5.356,18.406,10M17.521,10c0-4.148-3.374-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.147,17.521,17.521,14.147,17.521,10"></path>
                        </svg>
                    </div>
                </div>
                <form  class='search-newConversation-form msgRecu' id='search-newConversation-form' style="margin-bottom: 0px;">
                                    <input type='text' id='search-conversation' placeholder='Search a conversation'><br>
                                    <input class="button-primary search-newConversation-submit" id='search-newConversation-submit' type="submit" value="Enter the person's pseudo">
                                </form>
                <?php 
                include "getMessagerie.php";
                ?>   
            </div>

            <div class="five columns">
                <div class="pre-conversation">
                    <div class="conversation" id="conversation">
                        <div class="texte">
                            <strong>Enter the pseudo for start or search a conversation</strong>
                                <form  class='search-newConversation-form msgRecu' style="margin-bottom: 0px;" id='search-newConversation-form' >
                                    <input type='text' id='search-conversation' placeholder='Search a conversation'><br>
                                    <input class="button-primary search-newConversation-submit" id='search-newConversation-submit' type="submit" value="Enter the person's pseudo">
                                </form>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>