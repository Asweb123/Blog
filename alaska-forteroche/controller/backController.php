<?php

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');

function loginRegister($name, $password)
{
    if(($name === 'JF') AND ($password === 'XS')) {
        $postList = postList();
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

    require ('view/backend/administrationView.php');
}

function deletePost($postId)
{
    $postManager = new PostManager();
    $postManager->deletePost($postId);

    require ('view/backend/administrationView.php');
}