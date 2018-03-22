<?php

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');
require_once ('model/Pagination.php');


function admin()
{
    $postManager = new PostManager();
    $postList = $postManager->getPostList();

    $commentManager =new CommentManager();
    $checkedModeratedList = $commentManager->getCheckedModeratedList();
    $moderatedList = $commentManager->getModeratedList();

    require ('view/backend/administrationView.php');
}


function addPost()
{
    require ('view/backend/addPostView.php');
}


function addedPost($post_chapter, $post_title, $post_content)
{
    $postManager = New PostManager();
    $postManager->insertPost($post_chapter, $post_title, $post_content);

    header ('location: console.php');
}


function publishPost($postId)
{
    $postManager = New PostManager();
    $postManager->publishPost($postId);

    header ('location: console.php');
}


function readPost($postId)
{
    $postManager= new PostManager();
    $postSelected = $postManager->getPost($postId);

    require ('view/backend/readPostView.php');
}


function modifyPost($postId)
{
    $postManager= new PostManager();
    $postSelected = $postManager->getPost($postId);

    require ('view/backend/modifyPostView.php');
}


function modifiedPost($postId, $chapter, $post_title, $post_content)
{
    $postManager = new PostManager();
    $postManager->updatePost($postId, $chapter, $post_title, $post_content);

    header ('location: console.php');
}


function deletePost($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $comPostVerify = $commentManager->comPostVerify($postId);
    $test = $comPostVerify->fetch();

    if ($test != false) {
        $comPostTest = true;
    }
        $postManager->deletePost($postId, $comPostTest);



    header ('location: console.php');
}


function moderate($commentId)
{
    $commentManager = new CommentManager();
    $moderatedLine = $commentManager->moderate($commentId);

    if ($moderatedLine === false) {
        throw new Exception('Bug lors de l\'update de report à 3 de la table comments');
    } else {
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
}


function cancelModerate($commentId)
{
    $commentManager = new CommentManager();
    $cancelReportLine = $commentManager->cancelModerate($commentId);

    if ($cancelReportLine === false) {
        throw new Exception('Bug lors de l\'update de report à 1 de la table comments');
    } else {
        header("location:".  $_SERVER['HTTP_REFERER']);
    }
}

function commentAll()
{
    $commentManager = new CommentManager();
    $commentList = $commentManager->getCommentList();

    require('view/backend/commentListView.php');
}

function commentList($p)
{
    $perPage = 10;

    $pagination = new Pagination();
    $totalElement = $pagination->count();

    $nbPage = ceil($totalElement/$perPage);

    if($p > $nbPage){
        $current = $nbPage;
    } else {
        $current = $p;
    }

    $firstOfPage = ($current - 1) * $perPage;
    $commentPerPage = $pagination->elementPerPage($firstOfPage, $perPage);

    require('view/backend/commentListView.php');
}

