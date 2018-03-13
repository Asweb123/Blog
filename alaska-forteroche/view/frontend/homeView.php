<?php

$head_title = 'Billet simple pour l\'Alaska';

$accueilActive = 'active';

$chapitresActive = null;

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

<p>Présentation</p>

<?php
$content = ob_get_clean();

require('templateFront.php');