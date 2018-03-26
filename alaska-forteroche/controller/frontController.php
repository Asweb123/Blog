<?php

require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/Post.php';
require_once 'model/Comment.php';


function home()
{
    require 'view/frontend/homeView.php';
}

function allChapter()
{
    $postManager = new PostManager();
    $postList = $postManager->getPostList();

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


function reportComment($Id, $postId)
{
    $commentManager = new CommentManager();
    $reportedComment = $commentManager->reportComment($Id, 2);

    if($reportedComment === false) {
        throw new Exception('Impossible de signaler le commentaire');
    } else {
        header('location: index.php?action=chapter&id=' . $postId);
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
    }
    else {
        header('location: index.php?action=chapter&id=' . $idPost);
    }
}

/*


function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->addComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception ('Impossible d\'ajouter le commentaire.');
    }
    else {
        header('location: index.php?action=post&id=' . $postId);
    }
}


function report($commentId, $postId)
{
    $commentManager = new CommentManager();
    $reportedLine = $commentManager->reportComment($commentId);

    if($reportedLine === false) {
        throw new Exception('Impossible de signaler le commentaire');
    } else {
        header('location: index.php?action=post&id=' . $postId);
    }
}
*/