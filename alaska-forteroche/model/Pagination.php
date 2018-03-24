<?php
require_once('model/DbManager.php');

class Pagination extends DbManager
{
    public function count($table)
    {


        if ($table == 'comments') {
            $statement = 'SELECT COUNT(*) AS nbElement FROM comments';
        } else if ($table == 'posts') {
            $statement = 'SELECT COUNT(*) AS nbElement FROM posts';
        } else {
            throw new Exception('La table ' . $table . 'n\'existe pas');
        }

        $req = $this->executeRequest($statement);
        $result = $req->fetch();

        $totalElement = $result['nbElement'];

        return $totalElement;
    }

    public function ElementPerPage($table, $firstOfPage, $perPage)
    {
        if ($table == 'comments') {
            $statement = 'SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments ORDER BY id DESC LIMIT ? OFFSET ?';
        } else if ($table == 'posts') {
            $statement = 'SELECT id, chapter, post_title, publish FROM posts ORDER BY chapter DESC LIMIT ? OFFSET ?';
        } else {
            throw new Exception('La table ' . $table . 'n\'existe pas');
        }

        $elementPerPage = $this->executeRequest($statement, array($perPage, $firstOfPage));

        return $elementPerPage;

    }

}
