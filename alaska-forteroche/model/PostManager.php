<?php
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPostsId()
    {
        $dataLink = $this->dbConnect();
        $postsIdList = $dataLink->query('SELECT id FROM posts');

        return $postsIdList;
    }

    public function getPost($postId)
    {
        $dataLink = $this->dbConnect();
        $postRequest= $dataLink->prepare('SELECT id, post_title, post_content, DATE_FORMAT(post_date_init, 
\'%d/%m/%Y\') AS date_creation_fr FROM posts WHERE id = ?');
        $postRequest->execute(array($postId));
        $post = $postRequest->fetch();

        return $post;
    }
}