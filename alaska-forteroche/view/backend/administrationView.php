<?php $head_title = 'Administration' ?>

<?php ob_start(); ?>

<h1>Espace d'administration</h1>

<table>
    <caption style="caption-side: top">Gestion des chapitres :

    <form method="get" action="index.php?addPost" >
        <input type="submit" value="Ajouter">
    </form>

    <?php while ( $post = $postList->fetch())
    {
    ?>
    <tr>
        <td><?= $post['post_title'] ?></td>
        <td>
            <form method="get" action="index.php?readPost&id=<?= $post['id'] ?>" >
                <input type="submit" value="Voir">
            </form>
        </td>
        <td>
            <form method="get" action="index.php?modifyPost&id=<?= $post['id'] ?>" >
                <input type="submit" value="Modifier">
            </form>
        <td>
            <form method="get" action="index.php?deletePost&id=<?= $post['id'] ?>" >
                <input type="submit" value="Supprimer">
            </form>
        </td>
    </tr>
    <?php
    }
    ?>

</table>


<table>
    <caption style="caption-side: top">Gestion des commentaires :

    <td>Commentaire</td>
    <td>Chapitre</td>
    <td>Auteur</td>
    <td>Date</td>
    <td>Modérer</td>

    <?php while ( $comment = $commentList->fetch())
    {
    ?>
    <tr>
        <td><?= $comment['comment_content'] ?></td>
        <td><?= $comment['id_post'] ?></td>
        <td><?= $comment['comment_author'] ?></td>
        <td><?= $comment['date_comment_fr'] ?></td>
        <td>
            <form method="get" action="index.php?Moderate&id=<?= $comment['id'] ?>" >
                <input type="submit" value="Modérer">
            </form>
        </td>
    </tr>
    <?php
    }
    ?>

</table>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>
