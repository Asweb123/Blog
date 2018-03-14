<?php
require_once ('model/Manager.php');

class CommentManager extends Manager
{
    public function getCommentList()
    {
        $dataLink = $this->dbConnect();
        $commentList = $dataLink->query('SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments ORDER BY comment_date DESC');

        return $commentList;
    }

    public function getCheckedModeratedList()
    {
        $dataLink = $this->dbConnect();
        $checkedModeratedList = $dataLink->query('SELECT report FROM comments WHERE report = 2');

        return $checkedModeratedList;
    }

    public function getModeratedList()
    {
        $dataLink = $this->dbConnect();
        $moderatedList = $dataLink->query('SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments WHERE report = 2 ORDER BY comment_date DESC');

        return $moderatedList;
    }

    public function moderate($commentId)
    {
        $dataLink = $this->dbConnect();
        $commentReport = $dataLink->prepare('UPDATE comments SET report = ? WHERE id = ?');
        $moderatedLine = $commentReport->execute(array(3, $commentId));

        return  $moderatedLine;
    }

    public function cancelModerate($commentId)
    {
        $dataLink = $this->dbConnect();
        $cancelReport = $dataLink->prepare('UPDATE comments SET report = ? WHERE id = ?');
        $cancelReportLine = $cancelReport->execute(array(1, $commentId));

        return  $cancelReportLine;
    }
}