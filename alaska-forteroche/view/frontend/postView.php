<?php

$head_title = 'Chapitre ' . ($post['chapter']);

$accueilActive = null;

$chapitresActive = 'active';



ob_start();
while ($chapterNav = $chapterNavList->fetch())
{
    ?>
    <a class="dropdown-item" href="index.php?action=post&amp;id=<?= $chapterNav['id'] ?>">Chapitre <?= $chapterNav['chapter']?></a>
    <?php
}

?>
<?php $chapterNav = ob_get_clean();



ob_start();
?>
<section>
    <h1>Chapitre <?= $post['chapter'] ?></h1>
    <h2><?= $post['post_title'] ?></h2>
    <p><em>Publié le <?= $post['date_creation_fr'] ?></em></p>

    <p><?= $post['post_content'] ?></p>
<section/>

<section>
    <h4>Rédiger un commentaire</h4>
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for"author">Votre nom :</label><br/>
            <input type="text" id="author" name="author"/>
        </div>
        <div>
            <label for="comment">Votre commentaire :</label><br/>
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit"/>
        </div>
    </form>
</section>



<section>
    <?php
    while ($comment = $comments->fetch())
    {
    ?>
    <p>
        <strong><?= htmlspecialchars($comment['comment_author']) ?></strong><br/>
        <em>Le <?= htmlspecialchars($comment['date_comment_fr']) ?></em>
    </p>
        <?php
        switch ($comment['report']) {

            case 1:
                ?>
                <p><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>

            <form action="index.php?action=report" method="post">
                <input type="hidden" name="comment_id" id="comment_id" value="<?= $comment['id'] ?>"/>
                <input type="hidden" name="id_post" id="id_post" value="<?= $comment['id_post'] ?>"/>
                <input type="submit" value="Signaler comme inapproprié"/>
            </form>
                <?php
                break;

            case 2:
                ?>
                <p><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>
                <p>Ce commentaire à été signalé</p>
                <?php
                break;

            case 3:
                ?>
                <p>Ce message à été modéré</p>
                <?php
                break;
        }

    }
    ?>
</section>


<?php $content= ob_get_clean();

require('templateFront.php');



