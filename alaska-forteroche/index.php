<?php

// Filtrage de tout caractère non attendu dans l'URL
foreach ($_REQUEST as $key => $val)
{
    $val = preg_replace("/[^_A-Za-z0-9-\.&=]/i",'', $val);
    $_REQUEST[$key] = $val;
}



require('controller/frontController.php');

try {

    if (isset($_GET['action'])) {

        switch ($_GET['action']){

            case "allChapter":
                allChapter();
            break;

            case "chapter":
                if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
                    if (isset($_GET['com']) && $_GET['com'] == 'all') {
                        chapter($_GET['id'], 'all');
                    } else {
                        chapter($_GET['id'], null);
                    }
                } else {
                throw new Exception('L\'identifiant n\'est pas valide. ');
            }
            break;

            case "reportComment":
                if (isset($_POST['id']) AND isset($_POST['idPost'])) {
                    reportComment($_POST['id'], $_POST['idPost']);
                } else {
                    throw new Exception('Les id de commentaires et/ou de post ne sont pas valides.');
                }
                break;

            case "addComment":
                if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
                    if (!empty($_POST['author']) AND !empty($_POST['content'])) {
                        addComment($_GET['id'], $_POST['author'], $_POST['content']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis.');
                    }
                } else {
                    throw new Exception('Id de post non valide');
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