<?php

$head_title = 'Sommaire';

$chapterActive = 'active';

ob_start();
?>

    <header class="headerPost container-fluid">
        <div class="row h-100">
            <div class="titleBack mx-auto my-auto">
                <h1 class="text-center display-3 big-title-post">Les chapitres</h1>
            </div>
        </div>
    </header>

<?php
$header= ob_get_clean();

ob_start();
?>

<section>

<?php
foreach ($postList as $post)
{
?>

    <div>
        <a href="index.php?action=chapter&amp;id=<?= $post->id() ?>">
            <h2>Chapitre <?= $post->chapter() ?></h2>
            <h3><?= $post->title() ?></h3>
            <p>Publié le <?= $post->dateAdd() ?></p>
        </a>
    </div>

<?php
}
?>

</section>

<?php $content = ob_get_clean();

require 'view/frontend/templateFront.php';