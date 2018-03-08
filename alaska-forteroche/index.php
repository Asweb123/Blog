<?php
require('controller/frontController.php');

try {

    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if(isset($_GET['id']) AND ($_GET['id']>0)) {
                $chapterNavList = chapterNavList();
                post($chapterNavList);
            }
        } else if($_GET['action'] === 'addComment') {
            if(isset($_GET['id']) AND $_GET['id'] > 0) {
                if (!empty($_POST['author']) AND !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception ('Tous les champs ne sont pas remplis.');
                }
            }
            else {
                    throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        $chapterNavList = chapterNavList();
        require ('view/frontend/homeView.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
