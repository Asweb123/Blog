<?php

abstract class DbManager {

    private $db;

    protected function executeRequest($statement, $params = null) {
        if ($params == null) {
            $result = $this->getDb()->query($statement);
        }
        else {
            $result = $this->getDb()->prepare($statement);
            $result->execute($params);
        }
        return $result;
    }



    private function getDb() {
        if ($this->db == null) {
            $this->db = new PDO('mysql:host=localhost;dbname=as_blog_jf;charset=utf8',
                'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        }
        return $this->db;
    }

}