<?php
require_once('model/PostManager.php');
require_once('model/Post.php');


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

function chapter($id)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($id);

    require 'view/frontend/chapterView.php';
}

/*
function postPublished($id)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $chapterNavList = $postManager->getPostsChapter();
    $post = $postManager->getPostPublished($id);

    $comments = $commentManager->get5Comments($id);

    $comPostVerify = $commentManager->comPostVerify($id);
    $com5Test =$comPostVerify->fetchAll();
    $nbCom= count($com5Test);

    if ( ($nbCom <= 5)) {
        $moreComLink = false;
    } else {
        $moreComLink = true;
    }

    require ('view/frontend/postView.php');
}

function postPublishedAll($id)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $chapterNavList = $postManager->getPostsChapter();
    $post = $postManager->getPostPublished($id);
    $comments = $commentManager->getComments($id);

    require ('view/frontend/postView.php');
}


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