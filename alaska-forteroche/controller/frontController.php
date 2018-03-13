<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function chapterNavList()
{
    $postManager = new PostManager();
    $chapterNavList = $postManager->getPostsChapter();

    return $chapterNavList;
}

function post($id)
{
    $chapterNavList = chapterNavList();
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($id);
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