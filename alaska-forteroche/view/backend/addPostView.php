<?php $head_title = 'Ajouter un chapitre' ?>

<?php ob_start() ?>

<form action="index.php?action=addedPost" method="post">

    <label for="title">Titre du chapitre :</label>
    <input type="text" name="title" id="title"/>

    <label for "content">Contenu du chapitre :</label><br/>
    <textarea name="content" id="content"></textarea>

    <input type="submit" value="Enregistrer le chapitre">

</form>

<?php $content = ob_get_clean(); ?>

<?php require 'templateBack.php' ?>
