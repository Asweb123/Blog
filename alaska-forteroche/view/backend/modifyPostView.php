<?php $head_title = 'Chapitre ' . $postSelected['id']  ?>

<?php ob_start(); ?>


<form action="index.php?action=modifiedPost&amp;id=<?= $postSelected['id'] ?>" method="post">

    <label for="title">Modifier le titre du chapitre</label>
    <input type="text" name="title" id="title" value="<?= $postSelected['post_title'] ?>"/><br/>

    <label for="content">Modifier le contenu du chapitre</label>
    <textarea name="content" id="content"><?= $postSelected['post_content'] ?></textarea>

    <input type="submit" value="Enregistrer les modifications">

</form>



    <a href="#">Retour à l'espace d'administration</a>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>