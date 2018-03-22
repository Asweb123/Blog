<?php
require_once('model/DbManager.php');

class CommentManager extends DbManager
{

    public function get5Comments($postId)
    {
        $statement = 'SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments Where id_post = ? ORDER BY comment_date DESC LIMIT 5';
        $comments = $this->executeRequest($statement, array($postId));

        return $comments;
    }


    public function getComments($postId)
    {
        $statement = 'SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments Where id_post = ? ORDER BY comment_date DESC';
        $comments = $this->executeRequest($statement, array($postId));

        return $comments;
    }


    public function addComment($postId, $author, $comment)
    {
        $statement = 'INSERT INTO comments(id_post, comment_author, comment_content, comment_date)
VALUES(?, ?, ?, NOW())';
        $affectedLines = $this->executeRequest($statement, array($postId, $author, $comment));

        return $affectedLines;
    }

    public function comPostVerify($postId)
    {
        $statement = 'SELECT id FROM comments WHERE id_post = ?';
        $comPostVerify = $this->executeRequest($statement, array($postId));

        return $comPostVerify;
    }


    public function reportComment($commentId)
    {
        $statement = 'UPDATE comments SET report = ? WHERE id = ?';
        $reportedLine = $this->executeRequest($statement, array(2, $commentId));

        return $reportedLine;
    }


    public function getCheckedModeratedList()
    {
        $statement = 'SELECT report FROM comments WHERE report = 2';
        $checkedModeratedList = $this->executeRequest($statement);

        return $checkedModeratedList;
    }


    public function getModeratedList()
    {
        $statement = 'SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments WHERE report = 2 ORDER BY comment_date DESC';
        $moderatedList = $this->executeRequest($statement);

        return $moderatedList;
    }


    public function moderate($commentId)
    {
        $statement = 'UPDATE comments SET report = ? WHERE id = ?';
        $moderatedLine = $this->executeRequest($statement, array(3, $commentId));

        return $moderatedLine;
    }


    public function cancelModerate($commentId)
    {
        $statement = 'UPDATE comments SET report = ? WHERE id = ?';
        $cancelReportLine = $this->executeRequest($statement, array(1, $commentId));

        return $cancelReportLine;
    }


}