<?php
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPostsChapter()
    {
        $dataLink = $this->dbConnect();
        $postsChapterList = $dataLink->query('SELECT id, chapter FROM posts WHERE publish = 2 ORDER BY chapter ASC ');

        return $postsChapterList;
    }

    public function getPostPublished($id)
    {
        $dataLink = $this->dbConnect();
        $postRequest = $dataLink->prepare('SELECT id, post_title, post_content, chapter, DATE_FORMAT(post_date_init, 
\'%d/%m/%Y\') AS date_creation_fr FROM posts WHERE id = ? AND publish = 2');
        $postRequest->execute(array($id));
        $post = $postRequest->fetch();

        return $post;
    }
}