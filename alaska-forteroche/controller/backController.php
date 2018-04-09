<?php

require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/POPO/Post.php';
require_once 'model/POPO/Comment.php';

function admin($currentPage = 1)
{
//Gestion des chapitres
//Création de la pagination pour la liste de post avec 5 posts par page.
    $postManager = new PostManager();

    $totalPost = $postManager->count();
    $PerPage = 5;
    $totalPage = ceil($totalPost / $PerPage);

    //Gestion de $currentPage si supérieur au nombre total de page.
    if ($currentPage > $totalPage) {
        $currentPage = $totalPage;
    }

    //Définition du premier post à afficher.
    $firstOfPage = ($currentPage - 1) * $PerPage;

    $postPerPage = $postManager->getPostList('all', 'DESC', $firstOfPage, $PerPage);

//Gestion des commentaires
//Recuperation des commentaires signalés ou dans le cas contraire d'un tableau vide.
    $commentManager = new CommentManager();
    $reportedList = $commentManager->getCommentList(null, 'DESC', null, null, 'reported');

    if ($reportedList != null) {

    //Récupération du numéro de chapitre associé à chaque commentaire signalé en remplaçant dans $comment la valeur de l'attribut idPost
    //par le numéro de chapitre du post correspondant...  Pas très orthodoxe mais ça marche.
    $postList = $postManager->getPostList('published');

        foreach ($reportedList as $comment) {
            foreach ($postList as $post) {
                if (($post->id()) == ($comment->idPost())) {
                    $comment->setIdPost($post->chapter());
                }
            }
        }
    }
    require ('view/backend/administrationView.php');
}


function addPost()
{
    require ('view/backend/addPostView.php');
}


function addedPost($chapter, $title, $content)
{
    $post = new Post();

    $post->setChapter($chapter);
    $post->setTitle($title);
    $post->setContent($content);

    $postManager = New PostManager();
    $postManager->addPost($post);

    header ('location: console.php');
}


function modifyPost($id)
{
    $postManager= new PostManager();
    $post = $postManager->getPost($id);

    require ('view/backend/modifyPostView.php');
}


function publishPost($id)
{
    $postManager = New PostManager();
    $postManager->publishPost($id);

    header ('location: console.php');
}


function deletePost($idPost)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

//Vérification de l'existance de comment(s) pour ce post et si oui suppression des comment(s) associé(s).
    $comForPostTest = $commentManager->getCommentList($idPost);
    if(empty($comForPostTest) == true) {
        $comForPostExist = false;
    } else {
        $comForPostExist = true;
    }

    $postManager->deletePost($idPost, $comForPostExist);

    header ('location: console.php');
}

function modifiedPost($id, $chapter, $title, $content)
{
    $post = new Post();

    $post->setId($id);
    $post->setChapter($chapter);
    $post->setTitle($title);
    $post->setContent($content);

    $postManager = new PostManager();
    $postManager->updatePost($post);

    header ('location: console.php');
}


function moderate($id)
{
    $commentManager = new CommentManager();
    $moderatedLine = $commentManager->reportComment($id, 3);

    if ($moderatedLine === false) {
        throw new Exception('Erreur lors de l\'update de report à 3 dans la table comments');
    } else {
        header('location:'.  $_SERVER['HTTP_REFERER'] . '#commTable');
    }
}


function cancelModerate($id)
{
    $commentManager = new CommentManager();
    $cancelReportLine = $commentManager->reportComment($id, 1);

    if ($cancelReportLine === false) {
        throw new Exception('Erreur lors de l\'update de report à 1 dans la table comments');
    } else {
        header('location:'.  $_SERVER['HTTP_REFERER'] . '#commTable');
    }
}


function commentList($currentPage)
{
//Liste de tous les commentaires
//Création de la pagination pour la liste de commentaire avec 10 comments par page.
    $commentManager = new CommentManager();

    $totalComment = $commentManager->count();
    $PerPage = 10;
    $totalPage = ceil($totalComment/$PerPage);

    //Gestion de $currentPage si supérieur au nombre total de page.
    if ($currentPage > $totalPage) {
        $currentPage = $totalPage;
    }

    //Définition du premier commentaire à afficher.
    $firstOfPage = ($currentPage - 1) * $PerPage;

    $commentPerPage = $commentManager->getCommentList(null, 'DESC', $firstOfPage, $PerPage, null);

    //Récupération du chapitre associé à chaque commentaire en remplaçant dans $comment la valeur de l'attribut idPost
    //par le numéro de chapitre du post correspondant...  Pas très orthodoxe mais ça marche.
    $postManager = new PostManager();
    $postList = $postManager->getPostList('published');

    foreach ($commentPerPage as $comment) {
        foreach ($postList as $post) {
            if (($post->id()) == ($comment->idPost())){
                $comment->setIdPost($post->chapter());
            }
        }
    }

    require('view/backend/commentListView.php');
}

