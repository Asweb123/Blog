<?php $head_title = 'Console d\'administration' ?>

<?php ob_start(); ?>

<h1 class="text-center font-weight-bold my-5">Console d'administration</h1>


<section>

    <h2 class="d-inline align-middle">Gestion des chapitres :</h2>

    <form class="d-inline align-middle ml-3" method="post" action="console.php?action=addPost" >
        <input type="submit" class="btn btn-primary" value="Ajouter un chapitre">
    </form>

    <table class="table mt-4 mb-5 table-hover">

        <thead>
            <tr>
                <th class="border-top-0">Chapitre</th>
                <th class="border-top-0 text-center">Titre</th>
                <th class="border-top-0"></th>
                <th class="border-top-0"></th>
                <th class="border-top-0"></th>
            </tr>
        </thead>

        <tbody>
            <?php while ( $post = $postList->fetch())
            {
            ?>
            <tr>
                <td class="align-middle text-center"><?= $post['chapter'] ?></td>
                <td class="align-middle col-5 text-center"><?= $post['post_title'] ?></td>
                <td class="col-2">
                    <form action="console.php?action=readPost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-success" value="Voir">
                    </form>
                </td>
                <td class="col-2">
                    <form action="console.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-warning" value="Modifier">
                    </form>
                <?php
                if($post['publish'] == 1){
                ?>
                <td class="col-2 text-center">
                    <form action="console.php?action=publishPost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-info" style="width: 100px" value="Publier">
                    </form>
                </td>
                <?php
                } else {
                ?>
                <td class="col-2">
                    <form action="console.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-danger" style="width: 100px" value="Supprimer">
                    </form>
                </td>
                <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
        </tbody>

    </table>

</section>


<section>

    <h2 class="d-inline align-middle mt-5">Gestion de commentaires :</h2>

    <form class="d-inline align-middle ml-3" method="post" action="console.php?action=pagination&p=1" >
        <input type="submit" class="btn btn-primary" value="Voir tous les commentaires">
    </form>

    <?php
    $req = $checkedModeratedList->fetchall();
    $reportColumn = array_column($req, 'report');
    if (!in_array(2, $reportColumn)) {
        echo'<p class="text-success mt-4" style="font-size: 20px">Aucun commentaire signalé</p>';
    } else {
    ?>

    <table class="table mt-4 mb-5 table-hover">
        <thead>
            <tr>
                <th class="border-top-0">Commentaire(s) signalé(s)</th>
                <th class="border-top-0 align-middle text-center">Auteur</th>
                <th class="border-top-0 align-middle text-center">Date</th>
                <th class="border-top-0 align-middle text-center"></th>
                <th class="border-top-0 align-middle text-center"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            while ( $moderatedComment = $moderatedList->fetch() )
            {
            ?>
            <tr>
                <td class="align-middle"><?= $moderatedComment['comment_content'] ?></td>
                <td class="align-middle text-center"><?= $moderatedComment['comment_author'] ?></td>
                <td class="align-middle text-center"><?= $moderatedComment['date_comment_fr'] ?></td>
                <td>
                    <form action="console.php?action=moderate" method="post">
                        <input type="hidden" id="comment_id" name="comment_id" value="<?= $moderatedComment['id'] ?>"/>
                        <input type="submit" class="btn btn-danger" value="Modérer"/>
                    </form>
                </td>
                <td>
                    <form action="console.php?action=cancelModerate" method="post">
                        <input type="hidden" id="comment_id" name="comment_id" value="<?= $moderatedComment['id'] ?>"/>
                        <input type="submit" class="btn btn-success" value="Ignorer"/>
                    </form>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    ?>

</section>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>
