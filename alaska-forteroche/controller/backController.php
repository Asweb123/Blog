<?php

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');

function loginRegister($name, $password)
{
    if(($name === 'JF') AND ($password === 'XS')) {
        $postList = postList();
        $moderatedList = moderatedList();
        $commentList = commentList();

        require ('view/backend/administrationView.php');


    } else {
        require ('view/backend/loginView.php');
    }
}


function postList()
{
     $postManager = new PostManager();
     $postList = $postManager->getPostList();

     return $postList;
}

function commentList()
{
    $commentManager =new CommentManager();
    $commentList = $commentManager->getCommentList();

    return $commentList;
}

function addPost()
{
    require ('view/backend/addPostView.php');
}

function addedPost($post_title, $post_content)
{
    $postManager = New PostManager();
    $postManager->insertPost($post_title, $post_content);

    header ('location: index.php?action=admin');
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

function modifiedPost($postId, $post_title, $post_content)
{
    $postManager = new PostManager();
    $postModified =$postManager->updatePost($postId, $post_title, $post_content);

    header ('location: index.php?action=admin');
}

function deletePost($postId)
{
    $postManager = new PostManager();
    $postManager->deletePost($postId);

    header ('location: index.php?action=admin');
}

function moderate($commentId)
{
    $commentManager = new CommentManager();
    $moderatedLine = $commentManager->moderate($commentId);

    if ($moderatedLine === false) {
        throw new Exception('Bug lors de l\'update de report à 3 de la table comments');
    } else {
        header ('location: index.php?action=admin');
    }
}

function cancelModerate($commentId)
{
    $commentManager = new CommentManager();
    $cancelReportLine = $commentManager->cancelModerate($commentId);

    if ($cancelReportLine === false) {
        throw new Exception('Bug lors de l\'update de report à 1 de la table comments');
    } else {
        header ('location: index.php?action=admin');
    }
}

function moderatedList()
{
    $commentManager = new CommentManager;
    $moderatedList = $commentManager->getModeratedList();

    return $moderatedList;
}