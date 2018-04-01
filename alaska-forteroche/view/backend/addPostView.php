<?php $head_title = 'Ajouter un chapitre' ?>

<?php ob_start() ?>

<h1 class="text-center my-5">Ajouter un chapitre</h1>

<form action="console.php?action=addedPost" method="post">
    <div class="form-group font-weight-bold">
        <label for="chapter">Numéro du chapitre :</label>
        <input type="text" class="form-control" name="chapter" id="chapter" maxlength="3" required/><br/>
    </div>
    <div class="form-group font-weight-bold">
        <label for="title">Titre du chapitre :</label>
        <input type="text" class="form-control" name="title" id="title" maxlength="30" required/><br/>
    </div>
    <div class="form-group font-weight-bold">
        <label for "content">Contenu du chapitre :</label><br/>
        <textarea rows="25" name="content" class="form-control" id="content"></textarea>
    </div>
    <div class="form-group text-right">
        <input type="submit" class="btn btn-primary mb-2" value="Enregistrer le brouillon">
    </div>
</form>

<p class="text-center my-5">
    <a class="font-weight-bold" href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>

