<?php

class Post
{

    protected   $id,
                $chapter,
                $title,
                $content,
                $dateAdd,
                $publish,
                $errors = [];

    /**
     * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
     */
    const CHAPITRE_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;
    const PUBLISH_INVALIDE = 4;


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
     * Méthode permettant de savoir si le post est valide.
     * @return bool
     */
    public function isValid()
    {
        return !(empty($this->chapter) || empty($this->title) || empty($this->content));
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

    public function chapter()
    {
        return $this->chapter;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function dateAdd()
    {
        return $this->dateAdd;
    }

    public function publish()
    {
        return $this->publish;
    }



    // SETTERS //

    public function setId($id)
    {
            $this->id = (int) $id;
    }

    public function setChapter($chapter)
    {
        $this->chapter = (int) $chapter;
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
            $this->errors[] = self::TITRE_INVALIDE;
        }
        else
        {
            $this->title = $title;
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

    public function setDateAdd(DateTime $date)
    {
        $this->date = $date;
    }

    public function setPublish($publish)
    {
        if (($publish != 1) || ($publish != 2))
        {
            $this->errors[] = self::PUBLISH_INVALIDE;
        }
        else
        {
            $this->publish = $publish;
        }
    }

}