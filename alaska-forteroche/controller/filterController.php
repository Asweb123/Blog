<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');


$postManager = new PostManager();
$idPostList = $postManager->getPostsIdPublished();


function idPostController($idPost)
{

    $postManager = new PostManager();
    $idPostList = $postManager->getPostsIdPublished();
    $idPostList = $idPostList->fetchAll(PDO::FETCH_COLUMN, 0);

    if (!isset($idPost))  {
        $errorMessage = 'L\'id du post n\'a pas été passé en parametre.';

    } else if (!ctype_digit($idPost)) {
        $errorMessage = 'L\'id n\'est pas un nombre entier.';

    }  else if (!in_array($idPost, $idPostList)) {
        $errorMessage = 'L\'id du post n\'existe pas.';
    }

    else {
        $errorMessage = null;
    }

    return $errorMessage;
}


