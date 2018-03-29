<?php

$head_title = 'Chapitre ' . $post->chapter();

$chapterActive = 'active';


ob_start();
?>

<header class="headerPost container-fluid">
    <div class="row h-100">
        <div class="titleBack mx-auto my-auto">
            <h1 class="text-center display-3 big-title-post"><?= $post->title() ?></h1>
        </div>
    </div>
</header>

<?php
$header= ob_get_clean();


ob_start();
?>

<section>
    <h1 class="text-center mt-5 chapter-nb">Chapitre <?= $post->chapter() ?></h1>
    <p class="text-center mb-5">Publié le <?= $post->dateAdd() ?></p>

    <div class="text-justify lead post-text"><?= $post->content() ?></div>

    <nav id="comment-zone" class="mt-5 clearfix">
        <?php
        if (isset($previousNavChapter))
        {
            ?>
            <a class="float-left" href="index.php?action=chapter&amp;id=<?= $previousNavId ?>"><button class="btn btn-info" >&laquo; Chapitre <?= $previousNavChapter ?></button></a>
            <?php
        }

        if (isset($nextNavChapter))
        {
            ?>
            <a class="float-right" href="index.php?action=chapter&amp;id=<?= $nextNavId ?>"><button class="btn btn-info"" >Chapitre <?= $nextNavChapter ?> &raquo;</button></a>
            <?php
        }
        ?>
    </nav>

</section>



<section class="my-5" >
    <h4 class="mb-3">Rédiger un commentaire</h4>
    <form action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post">
        <div class="form-group font-weight-bold">
            <label for"author">Votre pseudo :</label><br/>
            <input class="form-control col-md-4 box-shadow" type="text" id="author" name="author" required/>
        </div>
        <div class="form-group font-weight-bold">
            <label for="content">Votre commentaire :</label><br/>
            <textarea rows="6" class="form-control box-shadow" id="content" name="content" required></textarea>
        </div>
        <div class="form-group font-weight-bold">
            <input class="btn btn-info" type="submit" value="Envoyer"/>
        </div>
    </form>
</section>



<section class="my-5">

    <?php
    foreach ($commentList as $comment)
    {
    ?>
    <div class="border my-3 p-3 rounded box-shadow comment-color clearfix">
        <p class="mb-2">
            <strong class="h5"><?= $comment->author() ?></strong>
            <em class="font-italic">Le <?= $comment->dateAdd() ?></em>
        </p>

        <?php
        switch ($comment->report()) {

            case 1:
                ?>
                <p class="mb-1"><?= nl2br($comment->content()) ?></p>

                <form class="text-right" action="index.php?action=reportComment" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $comment->id() ?>"/>
                    <input type="hidden" name="idPost" id="idPost" value="<?= $comment->idPost() ?>"/>
                    <input type="submit" class="mybtn " style="color: #138496; text-decoration: underline" value="Signaler le commentaire"/>
                </form>
                <?php
                break;

            case 2:
                ?>
                <p class="mb-1"><?= nl2br($comment->content()) ?></p>
                <p class="float-right mb-0" style="color: #138496">Commentaire signalé</p>
                <?php
                break;

            case 3:
                ?>
                <p class="alert alert-secondary mb-0">Ce commentaire a été modéré.</p>
                <?php
                break;

        }
    ?>
    </div>
    <?php
    }

    if ($moreComLink == true) {
        ?>
        <p class="text-center my-5 font-weight-bold">
            <a style="color: #138496" href="index.php?action=chapter&amp;id=<?= $post->id() ?>&amp;com=all" >Voir tous les commentaires</a>
        </p>
        <?php
    }
    ?>

</section>




<?php $content= ob_get_clean();

require('templateFront.php');



