<?php

class Comment
{

    protected   $id,
                $idPost,
                $author,
                $content,
                $dateAdd,
                $report,
                $errors = [];

    /**
     * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
     */
    const AUTEUR_INVALIDE = 1;
    const CONTENU_INVALIDE = 2;
    const REPPORT_INVALIDE = 3;


    /**
     * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
     * @param $values array Les valeurs à assigner
     * @return void
     */
    public function __construct($values = [])
    {
        if (!empty($values)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
        {
            $this->hydrate($values);
        }
    }

    /**
     * Méthode assignant les valeurs spécifiées aux attributs correspondant.
     * @param $data array Les données à assigner
     * @return void
     */
    public function hydrate($data)
    {

        foreach ($data as $attribut => $value)
        {
            $method = 'set'.ucfirst($attribut);

            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }

    /**
     * Méthode permettant de savoir si le comment est valide.
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->author) || empty($this->content));
    }


    // GETTERS //

    public function errors()
    {
        return $this->errors;
    }

    public function id()
    {
        return $this->id;
    }

    public function idPost()
    {
        return $this->idPost;
    }

    public function author()
    {
        return $this->author;
    }

    public function content()
    {
        return $this->content;
    }

    public function dateAdd()
    {
        return $this->dateAdd;
    }

    public function report()
    {
        return $this->report;
    }



    // SETTERS //

    public function setId($id)
    {
            $this->id = (int) $id;
    }

    public function setIdPost($idPost)
    {
        $this->idPost = (int) $idPost;
    }

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author))
        {
            $this->errors[] = self::AUTEUR_INVALIDE;
        }
        else
        {
            $this->author = $author;
        }
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
            $this->errors[] = self::CONTENU_INVALIDE;
        }
        else
        {
            $this->content = $content;
        }
    }

    public function setDateAdd(DateTime $dateAdd)
    {
        $this->dateAdd = $dateAdd;
    }

    public function setReport($report)
    {
        if (($report != 1) || ($report != 2) || ($report != 3))
        {
            $this->errors[] = self::REPORT_INVALIDE;
        }
        else
        {
            $this->report = $report;
        }
    }

}