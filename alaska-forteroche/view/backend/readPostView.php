<?php $head_title = 'Chapitre ' . $postSelected['chapter'] ?>

<?php ob_start(); ?>

<section>
    <h1 class="text-center my-5">Chapitre <?= $postSelected['chapter'] ?></h1>
    <h2 class="text-center mb-5"><?= $postSelected['post_title'] ?></h2>
    <p><?= $postSelected['post_content'] ?></p>
</section>

<p class="text-center my-5">
    <a href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>
