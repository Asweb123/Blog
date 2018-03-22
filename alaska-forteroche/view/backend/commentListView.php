<?php $head_title = 'Console d\'administration' ?>

<?php ob_start(); ?>


<h1 class="my-5 text-center">Commentaires</h1>

<table class="table mt-4 mb-5 table-hover">

    <thead>
    <tr>
        <th class="border-top-0 ">Commentaire</th>
        <th class="border-top-0 align-middle text-center">Auteur</th>
        <th class="border-top-0 align-middle text-center">Date</th>
        <th class="border-top-0 align-middle text-center">Etat</th>
        <th class="border-top-0"></th>
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


<nav class="mb-5" aria-label="navigation commentaires">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($current == 1){echo 'disabled';}  ?>">
            <a class="page-link" href="console.php?action=pagination&amp;p=<?php if ($current != 1){echo $current-1;}else{echo $current;} ?>">Précédent</a>
        </li>

        <?php
        for($i=1; $i<=$nbPage; $i++){
            if($i == $current){
                ?>
                <li class="page-item active">
                    <a class="page-link" href="console.php?action=pagination&amp;p=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="page-item">
                    <a class="page-link" href="console.php?action=pagination&amp;p=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php
            }
        }
        ?>
        <li class="page-item <?php if ($current == $nbPage){echo 'disabled';} ?>">
            <a class="page-link" href="console.php?action=pagination&amp;p=<?php if ($current != $nbPage){echo $current+1;}else{echo $current;} ?>">Suivant</a>
        </li>

    </ul>
</nav>




<p class="text-center mb-5">
    <a href="console.php">Retour à l'espace d'administration</a>
</p>

<?php $content = ob_get_clean() ?>

<?php require ('templateBack.php'); ?>