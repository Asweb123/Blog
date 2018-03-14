<?php $head_title = 'Chapitre ' . $postSelected['chapter']  ?>

<?php ob_start(); ?>

<section>
    <h1>Chapitre <?= $postSelected['chapter'] ?></h1>
    <h2><?= $postSelected['post_title'] ?></h2>
    <p><?= $postSelected['post_content'] ?></p>
</section>

<a href="index.php?action=admin">Retour à l'espace d'administration</a>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>
