<?php

// Filtrage de tout caractère non attendu dans l'URL
foreach ($_REQUEST as $key => $val)
{
    $val = preg_replace("/[^_A-Za-z0-9-\.&=]/i",'', $val);
    $_REQUEST[$key] = $val;
}


require('controller/controller.php');


try {

    if (isset($_GET['action'])) {


        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) AND ($_GET['id'] > 0)) {
                postPublished($_GET['id']);
            }

        } else if ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                if (!empty($_POST['author']) AND !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé.');
            }

        } else if ($_GET['action'] === 'report') {
            if (isset($_POST['comment_id']) AND isset($_POST['id_post'])) {
                report($_POST['comment_id'], $_POST['id_post']);
            } else {
                throw new Exception('Y a un bug avec les POST');
            }
        }

    } else {
        $chapterNavList = chapterNavList();
        require('view/homeView.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
