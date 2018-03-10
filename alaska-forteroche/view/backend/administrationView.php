<?php $head_title = 'Administration' ?>

<?php ob_start(); ?>

<h1>Console d'administration</h1>

<table>
    <caption style="caption-side: top">Gestion des chapitres :

    <form method="post" action="index.php?action=addPost" >
        <input type="submit" value="Ajouter">
    </form>

    <?php while ( $post = $postList->fetch())
    {
    ?>
    <tr>
        <td><?= $post['post_title'] ?></td>
        <td>
            <form action="index.php?action=readPost&amp;id=<?= $post['id'] ?>" method="post">
                <input type="submit" value="Voir">
            </form>
        </td>
        <td>
            <form action="index.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
                <input type="submit" value="Modifier">
            </form>
        <td>
            <form action="index.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="post">
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
            <form action="index.php?action=moderate" method="post">
                <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['id'] ?>"/>
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
