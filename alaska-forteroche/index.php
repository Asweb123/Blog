<?php
require('controller/frontController.php');

try {

    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'post') {
            if(isset($_GET['id']) AND ($_GET['id']>0)) {
                $chapterNavList = chapterNavList();
                post($chapterNavList);
            }
        }
    }
    else {
        $chapterNavList = chapterNavList();
        require ('view/frontend/homeView.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
