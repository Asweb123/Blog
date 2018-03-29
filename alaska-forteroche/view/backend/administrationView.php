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
            <?php
            foreach ($postPerPage as $post)
            {
            ?>
            <tr>
                <td class="align-middle text-center"><?= $post->chapter() ?></td>
                <td class="align-middle col-5 text-center"><?= $post->title() ?></td>
                <td class="">
                    <form action="console.php?action=modifyPost&amp;id=<?= $post->id() ?>" method="post">
                        <input type="submit" class="btn btn-warning" style="width: 100px" value="Modifier">
                    </form>
                <?php
                if($post->publish() == 1){
                ?>
                <td class=" text-center">
                    <form action="console.php?action=publishPost&amp;id=<?= $post->id() ?>" method="post">
                        <input type="submit" class="btn btn-info" style="width: 100px" value="Publier"
                               onclick="return(confirm('Etes-vous sûr de vouloir publier maintenant ce chapitre?'))">
                    </form>
                </td>
                <?php
                } else {
                ?>
                <td class="">
                    <form action="console.php?action=deletePost&amp;id=<?= $post->id() ?>" method="post">
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

    <nav class="mb-4" aria-label="navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($currentPage == 1){echo 'disabled';}  ?>">
                <a class="page-link" href="console.php?p=<?php if ($currentPage != 1){echo $currentPage-1;}else{echo $currentPage;} ?>">Précédent</a>
            </li>

            <?php
            for($i=1; $i<=$totalPage; $i++){
                if($i == $currentPage){
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
            <li class="page-item <?php if ($currentPage == $totalPage){echo 'disabled';} ?>">
                <a class="page-link" href="console.php?p=<?php if ($currentPage != $totalPage){echo $currentPage+1;}else{echo $currentPage;} ?>">Suivant</a>
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

    if (empty($reportedList)) {
        echo'<p class="text-success mt-4 text-center" style="font-size: 20px">Aucun commentaire signalé</p>';
    } else {
    ?>
    <table class="table mt-4 mb-3 table-hover">
        <thead>
            <tr>
                <th class="border-top-0">Commentaire(s) signalé(s)</th>
                <th class="border-top-0 align-middle text-center d-none d-md-table-cell">Auteur</th>
                <th class="border-top-0 align-middle text-center d-none d-md-table-cell">Chapitre</th>
                <th class="border-top-0 align-middle text-center d-none d-md-table-cell">Date</th>
                <th class="border-top-0 align-middle text-center d-none d-md-table-cell"></th>
                <th class="border-top-0 align-middle text-center d-none d-md-table-cell"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach($reportedList as $comment)
            {
            ?>
            <tr>
                <td class="align-middle"><?= $comment->content() ?></td>
                <td class="align-middle text-center d-none d-md-table-cell"><?= $comment->author() ?></td>
                <td class="align-middle text-center d-none d-md-table-cell"><?= $comment->idPost() ?></td>
                <td class="align-middle text-center d-none d-md-table-cell"><?= $comment->dateAdd() ?></td>
                <td class="">
                    <form action="console.php?action=moderate" method="post">
                        <input type="hidden" id="id" name="id" value="<?= $comment->id() ?>"/>
                        <input type="submit" class="btn btn-danger" style="width: 100px" value="Modérer"/>
                    </form>
                </td>
                <td class="">
                    <form action="console.php?action=cancelModerate" method="post">
                        <input type="hidden" id="id" name="id" value="<?= $comment->id() ?>"/>
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
