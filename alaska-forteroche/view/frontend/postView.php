<?php

$title = htmlspecialchars($post['post_title']);

$accueilActive = null;

$chapitresActive = 'active';

//Gestion Navigation Chapitres
ob_start();
while ($chapterNav = $chapterNavList->fetch())
{
    ?>
    <a class="dropdown-item" href="index.php?action=post&amp;id=<?= $chapterNav['id'] ?>">Chapitre <?= $chapterNav['id']?></a>
    <?php
}

?>
<?php $chapterNav = ob_get_clean();


//Contenu du chapitre
ob_start();
?>
<section>
    <h2><?= htmlspecialchars($post['post_title']) ?><h2>
    <h3>Publié le <?= $post['date_creation_fr'] ?></h3>

    <p><?= nl2br(htmlspecialchars($post['post_content'])) ?></p>
<section/>



<section>
    <h4>Commentaires</h4>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <h5><?= htmlspecialchars($comment['comment_author']) ?></h5>
        <h6><?= htmlspecialchars($comment['date_comment_fr']) ?></h6>
        <p><?= nl2br(htmlspecialchars($comment['comment_content'])) ?></p>
    <?php
    }
    ?>
</section>


<?php $content= ob_get_clean();

require ('template.php');



