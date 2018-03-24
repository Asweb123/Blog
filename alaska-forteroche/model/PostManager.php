<?php
require_once('model/DbManager.php');
class PostManager extends DbManager
{
    public function getPostsIdPublished()
    {
        $statement = 'SELECT id FROM posts WHERE publish = 2';
        $postsChapterList = $this->executeRequest($statement);

        return $postsChapterList;
    }

    public function getPostsChapter()
    {
        $statement = 'SELECT id, chapter FROM posts WHERE publish = 2 ORDER BY chapter ASC ';
        $postsChapterList = $this->executeRequest($statement);

        return $postsChapterList;
    }


    public function getPostList()
    {
        $statement = 'SELECT id, chapter, post_title, publish FROM posts ORDER BY chapter DESC';
        $postList = $this->executeRequest($statement);

        return $postList;
    }


    public function getPostPublished($id)
    {
        $statement = 'SELECT id, post_title, post_content, chapter, DATE_FORMAT(post_date_init, 
\'%d/%m/%Y\') AS date_creation_fr FROM posts WHERE id = ? AND publish = 2';
        $postRequest = $this->executeRequest($statement, array($id));
        $post = $postRequest->fetch();

        return $post;
    }


    public function getPost($id)
    {
        $statement = 'SELECT id, post_title, post_content, chapter, publish, DATE_FORMAT(post_date_init, 
\'%d/%m/%Y\') AS date_creation_fr FROM posts WHERE id = ?';
        $postRequest = $this->executeRequest($statement, array($id));
        $post = $postRequest->fetch();

        return $post;
    }


    public function insertPost($post_chapter, $post_title, $post_content)
    {
        $statement = 'INSERT INTO posts (chapter, post_title, post_content, post_date_init) VALUES (?, ?, ?, NOW())';
        $this->executeRequest($statement, array($post_chapter, $post_title, $post_content));
    }


    public function publishPost($postId)
    {
        $statement = 'UPDATE posts SET publish = 2, post_date_init = NOW() WHERE id= ?';
        $this->executeRequest($statement, array($postId));
    }


    public function updatePost($postId, $chapter, $post_title, $post_content)
    {
        $statement = 'UPDATE posts SET chapter = ?, post_title = ?, post_content = ? WHERE id = ?';
        $this->executeRequest($statement, array($chapter, $post_title, $post_content, $postId));
    }


    public function deletePost($postId, $comPostTest)
    {
        if ($comPostTest == true) {
            $statement = 'DELETE posts, comments FROM posts INNER JOIN comments ON comments.id_post = posts.id WHERE posts.id = ?';
        } else {
            $statement = 'DELETE FROM posts WHERE id = ?';
        }

        $this->executeRequest($statement, array($postId));
    }
}