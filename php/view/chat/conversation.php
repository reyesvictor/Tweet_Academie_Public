<?php
//origin
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../../../index.php");
}
if(!isset($_GET['chat']))
{
    header("Location: messagerie.php");
}
include "../../autoloader/autoloader.php";
$idUser = intval($_SESSION['id'][0]['id']); // Id de l'user connecté en int 
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8" />
    <title><?php echo $_GET['chat'];?> / Twiter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src='../../../js/jquery.uncompressed.3.4.1.js'></script>
    <script src = "../../../js/chat/sendMessage.js"></script>
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
                        <svg viewBox="0 0 24 24" class="logo-msg color-theme"><g><path d="M23.25 3.25h-2.425V.825c0-.414-.336-.75-.75-.75s-.75.336-.75.75V3.25H16.9c-.414 0-.75.336-.75.75s.336.75.75.75h2.425v2.425c0 .414.336.75.75.75s.75-.336.75-.75V4.75h2.425c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-3.175 6.876c-.414 0-.75.336-.75.75v8.078c0 .414-.337.75-.75.75H4.095c-.412 0-.75-.336-.75-.75V8.298l6.778 4.518c.368.246.79.37 1.213.37.422 0 .844-.124 1.212-.37l4.53-3.013c.336-.223.428-.676.204-1.012-.223-.332-.675-.425-1.012-.2l-4.53 3.014c-.246.162-.563.163-.808 0l-7.586-5.06V5.5c0-.414.337-.75.75-.75h9.094c.414 0 .75-.336.75-.75s-.336-.75-.75-.75H4.096c-1.24 0-2.25 1.01-2.25 2.25v13.455c0 1.24 1.01 2.25 2.25 2.25h14.48c1.24 0 2.25-1.01 2.25-2.25v-8.078c0-.415-.337-.75-.75-.75z"></path></g></svg>

                        </svg><a href="conversation.php"></a></li>
                    </div>
                </div>
                <div class="msgRecu">
                    <div id="demandeDeMsg">
                        <strong>Messages Requests</strong>
                        <svg viewBox="0 0 24 24" class="logo-msg color-theme"><g><path d="M17.207 11.293l-7.5-7.5c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L15.086 12l-6.793 6.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293l7.5-7.5c.39-.39.39-1.023 0-1.414z"></path></g></svg>
                    </div>
                </div>
                <form  class='search-newConversation-form msgRecu' style="margin-bottom: 0px;" id='search-newConversation-form'>
                                    <input type='text' id='search-conversation' placeholder='Search a conversation'><br>
                                    <input class="button-primary search-newConversation-submit btn-color-theme-primary" type="submit" value="Enter the person's pseudo">
                                </form>
                <?php 
                include "getMessagerie.php";
                ?>
            </div>

            <div class="five columns">
                <div class="pre-conversation">
                    <div class="destinataire">
                        <div class="pseudo">
                            <strong>
                            <?php
                            $objUserController = new UserController();
                            $verifPseudo = $objUserController->verifPseudoUnique($_GET['chat']);
                            if ($verifPseudo !== true)
                            {   
                                echo $_GET['chat'];
                            }
                            else
                            {
                                echo "undefined user";
                            }

                             ?>
                             </strong>

                        </div>
                    </div>
                    <div class="conversation" id="conversation">
                        <div class="texte">
                        <?php include "getConversation.php";?>
                        </div>
                    </div>
                </div>
                <div class="envoieMsg">
                    <?php include "sendMessage.php"; ?>
                </div>
            </div>
        </div>
    </div>