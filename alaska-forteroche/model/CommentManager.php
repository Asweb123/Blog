<?php
require_once 'model/DbManager.php';

class CommentManager extends DbManager
{

    /**
     * Méthode permettant d'ajouter un comment.
     * @param $comment Comment Le comment à ajouter
     * @return void
     */
    public function addComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(idPost, author, content, dateAdd) VALUES (:idPost, :author, :content, NOW())');

        $req->bindValue(':idPost', $comment->idPost());
        $req->bindValue(':author', $comment->author());
        $req->bindValue(':content', $comment->content());

        $req->execute();


    }

    /**
     * Méthode renvoyant le nombre de comment total.
     * @param $id int parametre optionnel permettant d'obtenir le nombre de comment pour un post en particulier.
     * @return int Le nombre de comment.
     */
    public function count($id = null)
    {
        if ((int) $id != null)
        {
            $whereStatement = 'WHERE idPost = '. $id;
        }
        else
        {
            $whereStatement = '';
        }

        $db = $this->dbConnect();
        $nbComment = $db->query('SELECT COUNT(*) FROM comments ' . $whereStatement)->fetchColumn();

        return $nbComment;
    }


    /**
     * Méthode retournant une liste de comment demandé.
     * @param $direction string La valeur optionnelle 'DESC' permet d'obtenir les resultats du dernier au premier.
     * @param $debut int Valeur optionnelle Le premier comment à sélectionner
     * @param $limite int Valeur optionnelle Le nombre de comment à sélectionner
     * @param $report string La valeur optionnelle 'reported' uniquement les comments signalés.
     * @return array La liste des comment. Chaque entrée est une instance de Comment.
     */
    public function getCommentList($idPost = null, $direction = null, $debut = null, $limite = null, $report = null)
    {
        if ((int)$idPost)
        {
            $whereStatement = ' WHERE idPost = '. (int) $idPost;
        }

        else if ($report == 'reported')
        {
            $whereStatement = ' WHERE report = 2';
        }

        else
        {
            $whereStatement = '';
        }

        $sql = 'SELECT id, idPost, author, content, report, DATE_FORMAT(dateAdd, \'%d/%m/%Y à %Hh%i\') AS dateAdd 
FROM comments '.$whereStatement.' ORDER BY id';

        if ($direction == 'DESC')
        {
            $sql .= ' DESC';
        }

        if ($debut != null || $limite != null)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $db = $this->dbConnect();
        $req = $db->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Comment');

        $commentList = $req->fetchAll();

        return $commentList;
    }


    /**
     * Méthode permettant de gérer l'état de modération d'un commentaire.
     * @param $id int id du commentaire.
     * @param $reportValue int 1 = publié, 2 = signalé, 3 = modéré
     * @return void
     */
    public function reportComment($id, $reportValue)
    {

        $sql = 'UPDATE comments SET report = '. (int) $reportValue . ' WHERE id = '. (int) $id ;
        $db = $this->dbConnect();
        $db->prepare($sql)->execute();;

    }

}