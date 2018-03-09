<?php $head_title = 'Chapitre ' . $postSelected['id']  ?>

<?php ob_start(); ?>

<section>
    <h2><?= htmlspecialchars($postSelected['post_title']) ?></h2>
    <p><?= nl2br(htmlspecialchars($postSelected['post_content'])) ?></p>
</section>

<a href="#">Retour à l'espace d'administration</a>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>
