<?php $head_title = 'Connexion' ?>

<?php ob_start(); ?>

<p>Veuillez vous identifier</p>

<form action="index.php?action=admin" method="post">
    <div>
        <label for="name">Identifiant :</label><br/>
        <input type="text" name="name" id="name" autofocus required/><br/>
    </div>
    <div>
        <label for="password">Mot de passe :</label><br/>
        <input type="password" name="password" id="password" required/><br/>
    </div>
    <div>
        <input type="submit" value="Connexion"/>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require ('templateBack.php') ?>
