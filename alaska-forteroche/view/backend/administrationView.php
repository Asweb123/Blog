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
        <td>Chapitre <?= $post['chapter'] ?></td>
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
    <caption style="caption-side: top">Commentaire(s) signalé(s) :</caption>

    <th>Commentaire</th>
    <th>Auteur</th>
    <th>Date</th>
    <th>Modérer</th>
    <th>Ignorer</th>

        <?php while ( $moderatedComment = $moderatedList->fetch() )
        {
        ?>
        <tr>
            <td><?= $moderatedComment['comment_content'] ?></td>
            <td><?= $moderatedComment['comment_author'] ?></td>
            <td><?= $moderatedComment['date_comment_fr'] ?></td>
            <td>
                <form action="index.php?action=moderate" method="post">
                    <input type="hidden" id="comment_id" name="comment_id" value="<?= $moderatedComment['id'] ?>"/>
                    <input type="submit" value="Modérer"/>
                </form>
            </td>
            <td>
                <form action="index.php?action=cancelModerate" method="post">
                    <input type="hidden" id="comment_id" name="comment_id" value="<?= $moderatedComment['id'] ?>"/>
                    <input type="submit" value="Ignorer"/>
                </form>
            </td>
        </tr>
        <?php
        }
        ?>

</table>



<table>
    <caption style="caption-side: top">Gestion des commentaires :

    <th>Commentaire</th>
    <th>Auteur</th>
    <th>Date</th>
    <th>Etat</th>
    <th>Modérer</th>

    <?php while ( $comment = $commentList->fetch())
    {
    ?>
    <tr>
        <td><?= $comment['comment_content'] ?></td>
        <td><?= $comment['comment_author'] ?></td>
        <td><?= $comment['date_comment_fr'] ?></td>
        <td><?php
            switch ($comment['report']) {
                case 1:
                    echo 'Publié';
                break;

                case 2:
                    echo 'Signalé';
                break;

                case 3:
                    echo 'Modéré';
            }?>
        </td>


        <td><?php
            if ($comment['report'] == 3) { ?>
                <form action="index.php?action=cancelModerate" method="post">
                    <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['id'] ?>"/>
                    <input type="submit" value="Annuler la modération">
                </form>
            <?php
            } else { ?>
                <form action="index.php?action=moderate" method="post">
                    <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['id'] ?>"/>
                    <input type="submit" value="Modérer">
                </form>
            <?php
            }
            ?>
        </td>
    </tr>
    <?php
    }
    ?>

</table>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>
