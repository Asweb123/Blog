<?php

$head_title = 'Sommaire';

$chapterActive = 'active';

ob_start();
?>

    <header class="headerPost container-fluid box-shadow-nav">
        <div class="row h-100">
            <div class="titleBack mx-auto my-auto">
                <h1 class="text-center display-3 big-title-post">Chapitres</h1>
            </div>
        </div>
    </header>

<?php
$header= ob_get_clean();

ob_start();
?>

<section class="my-5">

<?php
foreach ($postList as $post)
{
?>
    <a href="index.php?action=chapter&amp;id=<?= $post->id() ?>" class="box-chapter">
        <div class="border rounded my-4 pt-2 pb-1 box-shadow box-chapter-div">
            <h1 class="text-center h3">Chapitre <?= $post->chapter() ?></h1>
            <h2 class="text-center h4"><?= $post->title() ?></h2>
            <p class="text-center">Publié le <?= $post->dateAdd() ?></p>
        </div>
    </a>
<?php
}
?>

</section>

<?php $content = ob_get_clean();

require 'view/frontend/templateFront.php';