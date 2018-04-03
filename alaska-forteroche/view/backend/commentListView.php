<?php $head_title = 'Console d\'administration' ?>

<?php ob_start(); ?>


<h1 class="my-5 text-center">Commentaires</h1>

<section class="border my-5 p-4 rounded box-shadow console-section">

    <table class="table mt-4 mb-5 table-hover" style="table-layout: fixed" id="commTable">

        <thead>
        <tr>
            <th class="border-top-0 commentTable">Commentaire</th>
            <th class="border-top-0 align-middle text-center d-none d-md-table-cell">Auteur</th>
            <th class="border-top-0 align-middle text-center d-none d-xl-table-cell">Chapitre</th>
            <th class="border-top-0 align-middle text-center d-none d-lg-table-cell">Date</th>
            <th class="border-top-0 align-middle text-center d-none d-sm-table-cell">Etat</th>
            <th class="border-top-0 align-middle text-center">Action</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach($commentPerPage as $comment)
        {
            ?>
            <tr>
                <td class="align-middle" style="word-wrap: break-word;"><?= nl2br(htmlspecialchars($comment->content())) ?></td>
                <td class="align-middle text-center d-none d-md-table-cell"><?= htmlspecialchars($comment->author()) ?></td>
                <td class="align-middle text-center d-none d-xl-table-cell"><?= $comment->idPost() ?></td>
                <td class="align-middle text-center d-none d-lg-table-cell"><?= $comment->dateAdd() ?></td>
                <td class="align-middle text-center font-weight-bold d-none d-sm-table-cell"
                    <?php
                    switch ($comment->report()) {
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
                    if ($comment->report() == 3) { ?>
                        <form action="console.php?action=cancelModerate" method="post">
                            <input type="hidden" id="id" name="id" value="<?= $comment->id() ?>"/>
                            <input type="submit" class="btn btn-success" style="width: 90px" value="Rétablir">
                        </form>
                        <?php
                    } else { ?>
                        <form action="console.php?action=moderate" method="post">
                            <input type="hidden" id="id" name="id" value="<?= $comment->id() ?>"/>
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

    <nav class="mb-4" aria-label="navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($currentPage == 1){echo 'disabled';}  ?>">
                <a class="page-link" href="console.php?action=commentList&amp;p=<?php if ($currentPage != 1){echo $currentPage-1;}else{echo $currentPage;} ?>">Précédent</a>
            </li>

            <?php
            for($i=1; $i<=$totalPage; $i++){
                if($i == $currentPage){
                    ?>
                    <li class="page-item active">
                        <a class="page-link" href="console.php?action=commentList&amp;p=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="console.php?action=commentList&amp;p=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="page-item <?php if ($currentPage == $totalPage){echo 'disabled';} ?>">
                <a class="page-link" href="console.php?action=commentList&amp;p=<?php if ($currentPage != $totalPage){echo $currentPage+1;}else{echo $currentPage;} ?>">Suivant</a>
            </li>
        </ul>
    </nav>

</section>


<p class="text-center mb-5">
    <a class="font-weight-bold" href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>