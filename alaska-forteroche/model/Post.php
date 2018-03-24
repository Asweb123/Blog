<?php

class Post
{

    private $_id,
            $_postTitle,
            $_postContent,
            $_postDate,
            $_chapter,
            $_publish;

    const UNPUBLISHED = 1;
    const PUBLISHED = 2;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }


    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }



    public function id()
    {
        return $this->_id;
    }

    public function postTitle()
    {
        return $this->_postTitle;
    }

    public function postContent()
    {
        return $this->_postContent;
    }

    public function postDate()
    {
        return $this->_postDate;
    }

    public function chapter()
    {
        return $this->_chapter;
    }

    public function publish()
    {
        return $this->_publish;
    }

    public function setId($id)
    {
        $id = intval($id);

        if ($id >= 0)
        {
            $this->_id = $id;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title))
        {
            $this->_title = $title;
        }
    }

    public function setPostContent($postContent)
    {
        if (is_string($postContent))
        {
            $this->_postContent = $postContent;
        }
    }

    public function setdate($date)
    {
        $this->_postDate = $date;
    }

    public function setChapter($chapter)
    {
        $chapter = intval($chapter);

        if ($chapter > 0)
        {
            $this->_id = $chapter;
        }
    }

    public function setPublish($publish)
    {
        if (in_array($publish, [self::PUBLISHED, self::UNPUBLISHED]))
        {
            $this->_publish = $publish;
        }
    }



}