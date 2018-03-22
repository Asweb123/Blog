<?php

$head_title = 'Chapitre ' . ($post['chapter']);

$chapitresActive = 'active';


ob_start();
while ($chapterNav = $chapterNavList->fetch())
{
    if ($chapterNav['chapter'] == $post['chapter']) {
        $BoldDropClass = 'font-weight-bold';
    } else {
        $BoldDropClass = '';
    }
    ?>
    <a class="dropdown-item <?=$BoldDropClass?> " href="index.php?action=post&amp;id=<?= $chapterNav['id'] ?>">Chapitre <?= $chapterNav['chapter']?></a>
<?php
}
?>
<?php $chapterNav = ob_get_clean();


ob_start(); ?>

<header class="headerPost container-fluid">
    <div class="row h-100">
        <div class="titleBack mx-auto my-auto">
            <h1 class="text-center display-3 big-title-post"><?= $post['post_title'] ?></h1>
        </div>
    </div>
</header>

<?php $header= ob_get_clean();


ob_start();
?>
<section>
    <h1 class="text-center mt-5 ">Chapitre <?= $post['chapter'] ?></h1>
    <p class="text-center mb-5">Publié le <?= $post['date_creation_fr'] ?></p>

    <div class="text-justify lead post-text"><?= $post['post_content'] ?></div>
<section/>

<section class="my-5">
    <h4 class="mb-3">Rédiger un commentaire</h4>
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div class="form-group font-weight-bold">
            <label for"author">Votre nom :</label><br/>
            <input class="form-control col-4 box-shadow" type="text" id="author" name="author"/>
        </div>
        <div class="form-group font-weight-bold">
            <label for="comment">Votre commentaire :</label><br/>
            <textarea rows="6" class="form-control box-shadow" id="comment" name="comment"></textarea>
        </div>
        <div class="form-group font-weight-bold">
            <input class="btn btn-primary" type="submit" value="Envoyer"/>
        </div>
    </form>
</section>



<section class="my-5">

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <div class="border my-3 p-3 rounded box-shadow comment-color">
        <p class="mb-2">
            <strong class="h5"><?= htmlspecialchars($comment['comment_author']) ?></strong>
            <em class="font-italic">Le <?= htmlspecialchars($comment['date_comment_fr']) ?></em>
        </p>

        <?php
        switch ($comment['report']) {

            case 1:
                ?>
                <p class="mb-1"><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>

            <form class="text-right" action="index.php?action=report" method="post">
                <input type="hidden" name="comment_id" id="comment_id" value="<?= $comment['id'] ?>"/>
                <input type="hidden" name="id_post" id="id_post" value="<?= $comment['id_post'] ?>"/>
                <input type="submit" class="mybtn" value="Signaler comme inapproprié"/>
            </form>
                <?php
                break;

            case 2:
                ?>
                <p class="mb-1"><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>
                <p class="alert alert-warning mb-0">Ce commentaire a été signalé.</p>
                <?php
                break;

            case 3:
                ?>
                <p class="alert alert-danger mb-0">Ce commentaire a été modéré.</p>
                <?php
                break;

        }
    ?>
    </div>
    <?php
    }

    if (isset($moreComLink) AND ($moreComLink == true)) {
        ?>
        <p class="text-center my-5 font-weight-bold"><a href="index.php?action=postAllCom&amp;id=<?= $post['id'] ?>" >Voir tous les commentaires</a></p>
        <?php
    }
    ?>

</section>


<?php $content= ob_get_clean();

require('templateFront.php');



