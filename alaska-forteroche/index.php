<?php

// Filtrage de tout caractère non attendu dans l'URL
foreach ($_REQUEST as $key => $val)
{
    $val = preg_replace("/[^_A-Za-z0-9-\.&=]/i",'', $val);
    $_REQUEST[$key] = $val;
}

require('controller/filterController.php');
require('controller/frontController.php');

try {

    if (isset($_GET['action'])) {

        switch ($_GET['action']){

            case "post":
                $idTestError = idPostController($_GET['id']);
                if ($idTestError == null) {
                    postPublished($_GET['id']);
                } else {
                    throw new Exception($idTestError);
                }
            break;

            case "postAllCom":
                $idTestError = idPostController($_GET['id']);
                if ($idTestError == null) {
                    postPublishedAll($_GET['id']);
                } else {
                    throw new Exception($idTestError);
                }
                break;

            case "addComment":
                $idTestError = idPostController($_GET['id']);
                if ($idTestError == null) {
                    if (!empty($_POST['author']) AND !empty($_POST['comment'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis.');
                    }
                } else {
                    throw new Exception($idTestError);
                }
                break;

            case "report":
                if (isset($_POST['comment_id']) AND isset($_POST['id_post'])) {
                    report($_POST['comment_id'], $_POST['id_post']);
                } else {
                    throw new Exception('Les id de commentaires et/ou de post ne sont pas passés.');
                }
                break;

            default:
                home();
        }

    } else {
        home();
    }

} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}