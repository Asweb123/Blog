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

