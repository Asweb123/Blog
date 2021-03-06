<?php $head_title = 'Chapitre ' . $post->chapter(); ?>

<?php ob_start(); ?>

<h1 class="text-center my-5">Modifier un chapitre</h1>

<form action="console.php?action=modifiedPost&amp;id=<?= $post->id(); ?>" method="post">
    <div class="form-group font-weight-bold">
        <label for="chapter">Modifier le numéro du chapitre</label>
        <input type="text" class="form-control" name="chapter" id="chapter" maxlength="3" value="<?= $post->chapter() ?>"/><br/>
    </div>
    <div class="form-group font-weight-bold">
        <label for="title">Modifier le titre du chapitre</label>
        <input type="text" class="form-control" name="title" id="title" maxlength="30" value="<?= $post->title() ?>"/><br/>
    </div>
    <div class="form-group font-weight-bold">
        <label for="content">Modifier le contenu du chapitre</label>
        <textarea rows="25" name="content" class="form-control" id="content"><?= $post->content() ?></textarea>
    </div>
    <div class="form-group text-right">
        <input type="submit" class="btn btn-primary mb-2" value="Enregistrer les modifications">
    </div>
</form>

<p class="text-center my-5">
    <a class="font-weight-bold" href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>