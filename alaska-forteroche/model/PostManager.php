<?php
require_once('model/Manager.php');

class PostManager extends Manager
{
    public function getPostsChapter()
    {
        $dataLink = $this->dbConnect();
        $postsChapterList = $dataLink->query('SELECT id, chapter FROM posts ORDER BY chapter ASC ');

        return $postsChapterList;
    }

    public function getPostList()
    {
        $dataLink = $this->dbConnect();
        $postList= $dataLink->query('SELECT id, chapter, post_title FROM posts ORDER BY chapter ASC');

        return $postList;
    }

    public function getPost($id)
    {
        $dataLink = $this->dbConnect();
        $postRequest = $dataLink->prepare('SELECT id, post_title, post_content, chapter, DATE_FORMAT(post_date_init, 
\'%d/%m/%Y\') AS date_creation_fr FROM posts WHERE id = ?');
        $postRequest->execute(array($id));
        $post = $postRequest->fetch();

        return $post;
    }

    public function insertPost($post_chapter, $post_title, $post_content)
    {
        $dataLink = $this->dbConnect();
        $postRequest = $dataLink->prepare('INSERT INTO posts (chapter, post_title, post_content, post_date_init) VALUES (?, ?, ?, NOW())');
        $postRequest->execute(array($post_chapter, $post_title, $post_content));

    }

    public function updatePost($postId, $chapter, $post_title, $post_content)
    {
        $dataLink =$this->dbConnect();
        $postRequest = $dataLink->prepare('UPDATE posts SET chapter = ?, post_title = ?, post_content = ? WHERE id = ?');
        $postRequest->execute(array($chapter, $post_title, $post_content, $postId));
    }

    public function deletePost($postId)
    {
        $dataLink = $this->dbConnect();
        $postRequest = $dataLink->prepare('DELETE FROM posts WHERE id = ?');
        $postRequest->execute(array($postId));
    }
}