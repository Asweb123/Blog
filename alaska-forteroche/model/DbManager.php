<?php
class DbManager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog_jf;charset=utf8', 'root', '');
        return $db;
    }

}