<?php
require_once 'model/DbManager.php';

class PostManager extends DbManager
{

    /**
     * Méthode permettant d'ajouter un post.
     * @param $post Post Le post à ajouter
     * @return void
     */
    public function addPost(Post $post)
    {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO posts(chapter, title, content, dateAdd) VALUES (:chapter, :title, :content, NOW())');

            $req->bindValue(':chapter', $post->chapter());
            $req->bindValue(':title', $post->title());
            $req->bindValue(':content', $post->content());

            $req->execute();
    }

    /**
     * Méthode renvoyant le nombre de post total.
     * @return int
     */
    public function count()
    {
        $db = $this->dbConnect();
        return $db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    }

    /**
     * Méthode permettant de supprimer un post.
     * @param $id int L'identifiant du post à supprimer
     * @param $comForPostExist bool Si il y a des comments à supprimer également pour ce post.
     * @return void
     */
    public function deletePost($idPost, $comForPostExist)
    {
        $db = $this->dbConnect();

        if ($comForPostExist === true) {
            $req = $db->prepare('DELETE posts, comments FROM posts INNER JOIN comments ON comments.idPost = posts.id WHERE posts.id = :id');
            $req->bindValue(':id', $idPost, PDO::PARAM_INT);
            $req->execute();
        } else {
            $db->exec('DELETE FROM posts WHERE id = '.(int) $idPost);
        }
    }

    /**
     * Méthode retournant une liste de post demandé.
     * @param $published string La valeur optionnelle 'published' permet d'obtenir uniquement les posts publiés.
     * @param $direction string La valeur optionnelle 'DESC' permet d'obtenir les resultats du dernier au premier.
     * @param $start int Le premier post à sélectionner
     * @param $limit int Le nombre de post à sélectionner
     * @return array La liste des posts. Chaque entrée est une instance de Post.
     */
    public function getPostList($published = null, $direction = null, $start = null, $limit = null)
    {
        if ($published == 'published')
        {
            $whereStatement = ' WHERE publish = 2';
        }
        if ($published == 'all')
        {
            $whereStatement = '';
        }

        $sql = 'SELECT id, chapter, title, content, publish, DATE_FORMAT(dateAdd, \'%d/%m/%Y\') AS dateAdd 
FROM posts ' . $whereStatement . ' ORDER BY chapter';

        if ($direction == 'DESC')
        {
            $sql .= ' DESC';
        }

        if ($start != null || $limit != null)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $db = $this->dbConnect();
        $req = $db->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');

        $postList = $req->fetchAll();

        return $postList;
    }

    /**
     * Méthode retournant un post précis.
     * @param $id int L'identifiant du post à récupérer
     * @return Post Le post demandée
     */
    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, chapter, title, content, publish, DATE_FORMAT(dateAdd, \'%d/%m/%Y\') 
AS dateAdd FROM posts WHERE id = :id');
        $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $req->execute();

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');

        $post = $req->fetch();

        return $post;
    }


    /**
     * Méthode permettant de modifier un post.
     * @param $post Post le post à modifier
     * @return void
     */
    public function updatePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET chapter = :chapter, title = :title, content = :content WHERE id = :id');

        $req->bindValue(':chapter', $post->chapter());
        $req->bindValue(':title', $post->title());
        $req->bindValue(':content', $post->content());
        $req->bindValue(':id', $post->id(), PDO::PARAM_INT);

        $req->execute();
    }


    /**
     * Méthode permettant de publier un post.
     * @param $id int l'id du post à publier
     * @return void
     */
    public function publishPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET publish = 2 WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();

}   }