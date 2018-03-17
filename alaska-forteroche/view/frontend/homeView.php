<?php

$head_title = 'Billet simple pour l\'Alaska';

$accueilActive = 'active';

$chapitresActive = null;

ob_start();
?>
<header class="header">
    <div class="row h-100">
        <div class="titleBack mx-auto my-auto">
            <div>
            <h1 class="text-center display-3 mb-4">Billet simple pour l'Alaska</h1>
            <h3 class="text-center font-weight-light">par<br/>Jean Forteroche</h3>
            <div>
        </div>
    </div>
</header>

<?php
$header = ob_get_clean();

ob_start();
while ($chapterNav = $chapterNavList->fetch())
{
?>
<a class="dropdown-item" href="index.php?action=post&amp;id=<?= $chapterNav['id'] ?>">Chapitre <?= $chapterNav['chapter']?></a>
<?php
}
$chapterNavList->closeCursor();
?>
<?php $chapterNav = ob_get_clean();

ob_start();
?>
<section class="my-5">
    <p class="text-center lead">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <p class="text-center lead">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <form class="form text-center mt-5" action="index.php?action=post&id=1" method="post">
        <input type="submit" class="btn btn-primary" value="Commencer la lecture"/>
    </form>
</section>
<?php
$content = ob_get_clean();

require('templateFront.php');