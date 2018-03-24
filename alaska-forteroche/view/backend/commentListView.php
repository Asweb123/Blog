<?php $head_title = 'Console d\'administration' ?>

<?php ob_start(); ?>


<h1 class="my-5 text-center">Commentaires</h1>

<section class="border my-5 p-4 rounded box-shadow console-section">

    <table class="table mt-4 mb-5 table-hover">

        <thead>
        <tr>
            <th class="border-top-0 ">Commentaire</th>
            <th class="border-top-0 align-middle text-center">Auteur</th>
            <th class="border-top-0 align-middle text-center">Date</th>
            <th class="border-top-0 align-middle text-center">Etat</th>
            <th class="border-top-0 align-middle text-center">Action</th>
        </tr>
        </thead>

        <tbody>
        <?php while ( $comment = $commentPerPage->fetch())
        {
            ?>
            <tr>
                <td class="align-middle"><?= $comment['comment_content'] ?></td>
                <td class="align-middle text-center"><?= $comment['comment_author'] ?></td>
                <td class="align-middle text-center"><?= $comment['date_comment_fr'] ?></td>
                <td class="align-middle text-center font-weight-bold"
                    <?php
                    switch ($comment['report']) {
                        case 1:
                            echo ' style="color: #28a745;" >Publié';
                            break;

                        case 2:
                            echo ' style= "color: #ffc107;" >Signalé';
                            break;

                        case 3:
                            echo ' style="color: #dc3545;" >Modéré';
                    }?>
                </td>
                <td class="align-middle text-center">
                    <?php
                    if ($comment['report'] == 3) { ?>
                        <form action="console.php?action=cancelModerate" method="post">
                            <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['id'] ?>"/>
                            <input type="submit" class="btn btn-success" style="width: 90px" value="Rétablir">
                        </form>
                        <?php
                    } else { ?>
                        <form action="console.php?action=moderate" method="post">
                            <input type="hidden" id="comment_id" name="comment_id" value="<?= $comment['id'] ?>"/>
                            <input type="submit" class="btn btn-danger" style="width: 90px" value="Modérer">
                        </form>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php echo $navLink ?>

</section>


<p class="text-center mb-5">
    <a class="font-weight-bold" href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>