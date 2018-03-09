<?php
require('controller/frontController.php');
require('controller/backController.php');

try {

    if (isset($_GET['action'])) {


        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) AND ($_GET['id'] > 0)) {
                $chapterNavList = chapterNavList();
                post($chapterNavList);
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





        } else if ($_GET['action'] === 'admin') {
            if (!empty($_POST['name']) AND !empty($_POST['password'])) {
                loginRegister($_POST['name'], $_POST['password']);
            } else {
                require ('view/backend/loginView.php');
            }

        } else if ($_GET['action'] === 'readPost') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                readPost($_GET['id']);
            } else {
                throw new Exception('id de post non valide');
            }

        } else if ($_GET['action'] === 'modifyPost') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                modifyPost($_GET['id']);
            } else {
                throw new Exception('Y a un bug!');
            }

        } else if ($_GET['action'] === 'modifiedPost') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                if (!empty($_POST['title']) AND !empty($_POST['content'])) {
                    modifiedPost($_GET['id'], $_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('Il manque le titre ou le texte');
                }
            } else {
                throw new Exception('Y a un bug d\'id!');
            }

        } else if ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                deletePost($_GET['id']);
            } else {
                throw new Exception('Encore un bug');
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
