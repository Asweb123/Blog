<?php $head_title = 'Console d\'administration' ?>

<?php ob_start(); ?>

<h1 class="text-center font-weight-bold my-5">Console d'administration</h1>


<section class="border p-4 rounded box-shadow console-section">

    <h2 class=" align-middle text-center mb-4">Gestion des chapitres</h2>

    <form class=" align-middle ml-3 text-center" method="post" action="console.php?action=addPost" >
        <input type="submit" class="btn btn-primary" value="Ajouter un chapitre">
    </form>

    <table class="table mt-4 mb-5 table-hover">

        <thead>
            <tr>
                <th class="border-top-0">Chapitre</th>
                <th class="border-top-0 text-center">Titre</th>
                <th class="border-top-0"></th>
                <th class="border-top-0"></th>
            </tr>
        </thead>

        <tbody>
            <?php while ( $post = $postPerPage->fetch())
            {
            ?>
            <tr>
                <td class="align-middle text-center"><?= $post['chapter'] ?></td>
                <td class="align-middle col-5 text-center"><?= $post['post_title'] ?></td>
                <td class="">
                    <form action="console.php?action=modifyPost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-warning" style="width: 100px" value="Modifier">
                    </form>
                <?php
                if($post['publish'] == 1){
                ?>
                <td class=" text-center">
                    <form action="console.php?action=publishPost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-info" style="width: 100px" value="Publier"
                               onclick="return(confirm('Etes-vous sûr de vouloir publier maintenant ce chapitre?'))">
                    </form>
                </td>
                <?php
                } else {
                ?>
                <td class="">
                    <form action="console.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="post">
                        <input type="submit" class="btn btn-danger" style="width: 100px" value="Supprimer"
                               onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce chapitre?'))">
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


    <nav class="mb-4" aria-label="navigation chapitres">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($current == 1){echo 'disabled';}  ?>">
                <a class="page-link" href="console.php?p=<?php if ($current != 1){echo $current-1;}else{echo $current;} ?>">Précédent</a>
            </li>

            <?php
            for($i=1; $i<=$nbPage; $i++){
                if($i == $current){
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="console.php?p=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="console.php?p=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item <?php if ($current == $nbPage){echo 'disabled';} ?>">
                <a class="page-link" href="console.php?p=<?php if ($current != $nbPage){echo $current+1;}else{echo $current;} ?>">Suivant</a>
            </li>

        </ul>
    </nav>

</section>


<section class="border my-5 p-4 rounded box-shadow console-section">

    <h2 class="text-center align-middle  mb-4">Gestion des commentaires</h2>

    <form class="text-center align-middle ml-3" method="post" action="console.php?action=commentList&p=1" >
        <input type="submit" class="btn btn-primary" value="Voir tous les commentaires">
    </form>

    <?php
    $req = $checkedModeratedList->fetchall();
    $reportColumn = array_column($req, 'report');
    if (!in_array(2, $reportColumn)) {
        echo'<p class="text-success mt-4" style="font-size: 20px">Aucun commentaire signalé</p>';
    } else {
    ?>

    <table class="table mt-4 mb-3 table-hover">
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
                        <input type="submit" class="btn btn-danger" style="width: 100px" value="Modérer"/>
                    </form>
                </td>
                <td>
                    <form action="console.php?action=cancelModerate" method="post">
                        <input type="hidden" id="comment_id" name="comment_id" value="<?= $moderatedComment['id'] ?>"/>
                        <input type="submit" class="btn btn-success" style="width: 100px" value="Ignorer"/>
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
