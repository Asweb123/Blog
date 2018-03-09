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