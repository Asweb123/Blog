<?php

require_once ('model/PostManager.php');
require_once ('model/CommentManager.php');
/*
function loginRegister($name, $password)
{
    if(($name === 'JF') AND ($password === 'XS')) {
        $postList = postList();
        $checkedModeratedList = checkedModeratedList();
        $moderatedList = moderatedList();
        $commentList = commentList();

        require ('view/administrationView.php');


    } else {
        require ('view/loginView.php');
    }
}
*/

function admin()
{
    $postList = postList();
    $checkedModeratedList = checkedModeratedList();
    $moderatedList = moderatedList();
    $commentList = commentList();

    require ('view/administrationView.php');
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
    require ('view/addPostView.php');
}

function addedPost($post_chapter, $post_title, $post_content)
{
    $postManager = New PostManager();
    $postManager->insertPost($post_chapter, $post_title, $post_content);

    header ('location: index.php');
}

function publishPost($postId)
{
    $postManager = New PostManager();
    $postManager->publishPost($postId);

    header ('location: index.php');
}

function readPost($postId)
{
    $postManager= new PostManager();
    $postSelected = $postManager->getPost($postId);

    require ('view/readPostView.php');
}

function modifyPost($postId)
{
    $postManager= new PostManager();
    $postSelected = $postManager->getPost($postId);

    require ('view/modifyPostView.php');
}

function modifiedPost($postId, $chapter, $post_title, $post_content)
{
    $postManager = new PostManager();
    $postModified =$postManager->updatePost($postId, $chapter, $post_title, $post_content);

    header ('location: index.php');
}

function deletePost($postId)
{
    $postManager = new PostManager();
    $postManager->deletePost($postId);

    header ('location: index.php');
}

function moderate($commentId)
{
    $commentManager = new CommentManager();
    $moderatedLine = $commentManager->moderate($commentId);

    if ($moderatedLine === false) {
        throw new Exception('Bug lors de l\'update de report à 3 de la table comments');
    } else {
        header ('location: index.php');
    }
}

function cancelModerate($commentId)
{
    $commentManager = new CommentManager();
    $cancelReportLine = $commentManager->cancelModerate($commentId);

    if ($cancelReportLine === false) {
        throw new Exception('Bug lors de l\'update de report à 1 de la table comments');
    } else {
        header ('location: index.php');
    }
}

function checkedModeratedList()
{
    $commentManager = new CommentManager;
    $checkedModeratedList = $commentManager->getCheckedModeratedList();

    return $checkedModeratedList;
}

function moderatedList()
{
    $commentManager = new CommentManager;
    $moderatedList = $commentManager->getModeratedList();

    return $moderatedList;
}