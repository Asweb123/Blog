<?php

require('controller/backController.php');

try {

    if (isset($_GET['action'])) {

        switch ($_GET['action']) {

            case 'addPost';
                addpost();
                break;

            case 'addedPost';
                if ((!empty($_POST['chapter']) && is_numeric($_POST['chapter']) == true) AND !empty($_POST['title']) AND !empty($_POST['content'])) {
                    savePost($_POST['chapter'], $_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('Le numéro de chapitre, le titre ou le contenu du chapitre n\'est pas valide');
                }
                break;

            case 'modifyPost';
                if (isset($_GET['id']) AND $_GET['id'] > 0) {
                    modifyPost($_GET['id']);
                } else {
                    throw new Exception('id de post non valide');
                }
                break;

            case 'modifiedPost';
                if (isset($_GET['id']) AND $_GET['id'] > 0) {
                    if (!empty($_POST['chapter']) AND !empty($_POST['title']) AND !empty($_POST['content'])) {
                        modifiedPost($_GET['id'], $_POST['chapter'], $_POST['title'], $_POST['content']);
                    } else {
                        throw new Exception('Le numéro de chapitre, le titre ou le contenu du chapitre n\'a pas été renseigné');
                    }
                } else {
                    throw new Exception('id de post non valide');
                }
                break;

            case 'publishPost';
                if (isset($_GET['id']) AND $_GET['id'] > 0) {
                    publishPost($_GET['id']);
                } else {
                    throw new Exception('id de post non valide');
                }
                break;

            case 'deletePost';
                if (isset($_GET['id']) AND $_GET['id'] > 0) {
                    deletePost($_GET['id']);
                } else {
                    throw new Exception('id de post non valide');
                }
                break;

            case 'moderate';
                if (isset($_POST['id']) AND $_POST['id'] > 0) {
                    moderate($_POST['id']);
                } else {
                    throw new Exception('id de commentaire non valide');
                }
                break;

            case 'cancelModerate';
                if (isset($_POST['id']) AND $_POST['id'] > 0) {
                    cancelModerate($_POST['id']);
                } else {
                    throw new Exception('id de commentaire non valide!');
                }
                break;

            case 'commentList';
                if (isset($_GET['p']) AND (is_numeric($_GET['p']) == true) AND ($_GET['p'] > 0)) {
                    commentList($_GET['p']);
                } else {
                    throw new Exception('numéro de page non valide');
                }
                break;

            default:
                admin();
                break;
        }


    } else if (isset($_GET['p'])) {
        if ((is_numeric($_GET['p']) == true) AND ($_GET['p'] > 0)) {
            admin($_GET['p']);
        } else {
            throw new Exception('numéro de page non valide');
        }

    } else {
        admin();
    }

}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}