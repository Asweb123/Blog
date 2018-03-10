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

        } else if ($_GET['action'] === 'report') {
            if (isset($_POST['id']) AND isset($_POST['id_post'])) {
                report($_POST['id'], $_POST['id_post']);
            } else {
                throw new Exception('Y a un bug avec les POST');
            }




        } else if ($_GET['action'] === 'admin') {
            if (!empty($_POST['name']) AND !empty($_POST['password'])) {
                loginRegister($_POST['name'], $_POST['password']);
            } else {
                require ('view/backend/loginView.php');
            }

        } else if ($_GET['action'] === 'addPost') {
            addpost();

        } else if ($_GET['action'] === 'addedPost') {
            if (!empty($_POST['title']) AND !empty($_POST['content'])) {
                addedPost($_POST['title'], $_POST['content']);
            } else { echo 'Faire en sorte que JF soit redirigé vers la page d\'ajout avec le 
            contenu encore présent';
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
        } else if ($_GET['action'] === 'moderate') {
            if (isset($_POST['comment_id']) AND $_POST['comment_id'] > 0) {
                moderate($_POST['comment_id']);
            } else {
                throw new Exception('Pas d\'id passée en parametre');
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
