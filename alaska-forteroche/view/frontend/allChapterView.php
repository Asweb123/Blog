<?php

$head_title = 'Sommaire';

$chapterActive = 'active';

$headerHome= null;

ob_start();
?>

    <header class="headerPost container-fluid box-shadow-nav" title="photo d'un paysage d'Alaska">
        <div class="row h-100">
            <div class="titleBackChapter mx-auto my-auto">
                <h1 class="text-center display-3 big-title-post">Chapitres</h1>
            </div>
        </div>
    </header>

<?php
$headerRest= ob_get_clean();

ob_start();
?>

<section class="my-5">

<?php
foreach ($postPerPage as $post)
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
    <div class="pagiNav">
        <nav class="mt-5" aria-label="navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($currentPage == 1){echo 'disabled';}  ?>">
                    <a class="page-link" href="index.php?action=allChapter&amp;p=<?php if ($currentPage != 1){echo $currentPage-1;}else{echo $currentPage;} ?>">Précédent</a>
                </li>

                <?php
                for($i=1; $i<=$totalPage; $i++){
                    if($i == $currentPage){
                        ?>
                        <li class="page-item active">
                            <a class="page-link" href="index.php?action=allChapter&amp;p=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?action=allChapter&amp;p=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="page-item <?php if ($currentPage == $totalPage){echo 'disabled';} ?>">
                    <a class="page-link" href="index.php?action=allChapter&amp;p=<?php if ($currentPage != $totalPage){echo $currentPage+1;}else{echo $currentPage;} ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

</section>

<?php $content = ob_get_clean();

require 'view/frontend/templateFront.php';