<?php

require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/POPO/Post.php';
require_once 'model/POPO/Comment.php';


function home()
{
    require 'view/frontend/homeView.php';
}

function allChapter($currentPage)
{
//Affichage de tous les chapitres
//Création de la pagination avec 10 posts (chapitres) par page.
    $postManager = new PostManager();

    $totalPost = $postManager->count();
    $PerPage = 10;
    $totalPage = ceil($totalPost / $PerPage);

    //Gestion de $currentPage si supérieur au nombre total de page.
    if ($currentPage > $totalPage) {
        $currentPage = $totalPage;
    }

    //Définition du premier post à afficher.
    $firstOfPage = ($currentPage - 1) * $PerPage;

    $postPerPage = $postManager->getPostList('published', 'ASC', $firstOfPage, $PerPage);

    require 'view/frontend/allChapterView.php';
}

function chapter($id, $allcom = null)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($id);

// Si l'id n'a pas de chapitre associé, alors redirection vers l'accueil.
    if ($post == false) {
        require 'view/frontend/homeView.php';
    }

// Création des liens chapitre précédent et suivant.
    $postList = $postManager->getPostList('published');

    $currentChapter = $post->chapter();

    $previousChapter = $currentChapter - 1;
    $nextChapter = $currentChapter + 1;

    if ($previousChapter > 0) {
        foreach ($postList as $previousPost){
            if(($previousPost->chapter()) == $previousChapter) {
                $previousNavId = $previousPost->id();
                $previousNavChapter = $previousPost->chapter();
            }
        }
    }

    if($nextChapter <= count($postList)){
        foreach ($postList as $nextPost){
            if(($nextPost->chapter()) == $nextChapter) {
                $nextNavId = $nextPost->id();
                $nextNavChapter = $nextPost->chapter();
            }
        }
    }

// Si l'utilisateur desire voir tous les commentaires.
    if ($allcom == 'all') {
        $moreComLink = false;
        $commentList = $commentManager->getCommentList($id, 'DESC');
    } else {

//Sinon affichage du chapitre avec uniquement les 5 derniers commentaires.
        $nbComment = $commentManager->count($id);

        if ($nbComment <= 5) {
            $moreComLink = false;
        } else {
            $moreComLink = true;
        }

        $commentList = $commentManager->getCommentList($id, 'DESC', 0, 5);
    }

    require 'view/frontend/chapterView.php';
}


function reportComment($id, $postId)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($id, 2);

    if($reportedComment === false) {
        throw new Exception('Impossible de signaler le commentaire');
    } else {
        header('location: index.php?action=chapter&id=' . $postId . '&com=all#comments');
    }
}

function addComment($idPost, $author, $content)
{
    $comment = new Comment();
    $comment->setIdPost($idPost);
    $comment->setAuthor($author);
    $comment->setContent($content);

    $commentManager = new CommentManager();

    $addComment = $commentManager->addComment($comment);

    if ($addComment === false) {
        throw new Exception ('Impossible d\'ajouter le commentaire.');
    } else {
        header('location: index.php?action=chapter&id=' . $idPost . '#addComment');
    }
}

function author()
{
        require 'view/frontend/authorView.php';
}
