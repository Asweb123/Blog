<?php
require_once ('model/Manager.php');

class CommentManager extends Manager
{

    public function getComments($postId)
    {
        $dataLink = $this->dbConnect();
        $comments = $dataLink->prepare('SELECT id, comment_author, comment_content, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments Where id_post = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
}