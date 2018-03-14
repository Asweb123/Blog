<?php

require('controller/backController.php');

try {

    if (isset($_GET['action'])) {


        if ($_GET['action'] === 'admin') {
            if (!empty($_POST['name']) AND !empty($_POST['password'])) {
                loginRegister($_POST['name'], $_POST['password']);
            } else {
                require ('view/backend/loginView.php');
            }

        } else if ($_GET['action'] === 'addPost') {
            addpost();

        } else if ($_GET['action'] === 'addedPost') {
            if (!empty($_POST['chapter']) AND !empty($_POST['title']) AND !empty($_POST['content'])) {
                addedPost($_POST['chapter'], $_POST['title'], $_POST['content']);
            } else { echo 'Faire en sorte que JF soit redirigé vers la page d\'ajout avec le 
            contenu encore présent';
            }

        } else if ($_GET['action'] === 'publishPost') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                publishPost($_GET['id']);
            } else {
                throw new Exception('id de post non valide');
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
                if (!empty($_POST['chapter']) AND !empty($_POST['title']) AND !empty($_POST['content'])) {
                    modifiedPost($_GET['id'], $_POST['chapter'], $_POST['title'], $_POST['content']);
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
        } else if ($_GET['action'] === 'cancelModerate') {
            if (isset($_POST['comment_id']) AND $_POST['comment_id'] > 0) {
                cancelModerate($_POST['comment_id']);
            } else {
                throw new Exception('Pas d\'id passée en parametre');
            }
        }
    }






    else {
        admin();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
