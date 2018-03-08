<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function chapterNavList()
{
    $postManager = new PostManager();
    $chapterNavList = $postManager->getPostsId();

    return $chapterNavList;
}

function post($para1)
{
    $chapterNavList = $para1;
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require ('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines =$commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception ('Impossible d\'ahouter le commentaire.');
    }
    else {
        header('location: index.php?action=post&id=' . $postId);
    }
}