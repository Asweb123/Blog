<?php
require_once('model/DbManager.php');

class Pagination extends DbManager
{
    public function count()
    {

        $statement = 'SELECT COUNT(id) AS nbElement FROM comments';
        $req = $this->executeRequest($statement);
        $result = $req->fetch();
        $totalElement = $result['nbElement'];

        return $totalElement;
    }

    public function ElementPerPage($firstOfPage, $perPage)
    {
        $statement = 'SELECT id, id_post, comment_author, comment_content, report, DATE_FORMAT(comment_date, 
\'%d/%m/%Y à %Hh%i\') AS date_comment_fr FROM comments ORDER BY id DESC LIMIT ? OFFSET ?';

        $elementPerPage = $this->executeRequest($statement, array($perPage, $firstOfPage));

        return $elementPerPage;

    }

}
