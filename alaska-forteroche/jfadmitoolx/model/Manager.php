<?php

class Manager {

    protected function dbConnect()
    {
                $dataLink = new PDO('mysql:hot=localhost; dbname=as_blog_jf; charset=utf8', 'root', null);
                return $dataLink;
    }
}