<?php

$head_title = 'Billet simple pour l\'Alaska';

$accueilActive = 'active';



ob_start();
?>

    <div class="homepage-hero-module">
        <div class="video-container">
            <div class="filter"></div>
            <video autoplay loop class="fillWidth">
                <source src="public/video/MP4/Mt_Baker.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
                <source src="public/video/WEBEM/Mt_Baker.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
            </video>
            <div class="poster hidden">
                <img src="public/video/Snapshots/Mt_Baker.jpg" alt="">
            </div>
        </div>
    </div>


<header class="container-fluid headerHome">
    <div class="row h-100">
        <div class="titleBack mx-auto my-auto">
            <h1 class="text-center display-3 mb-4 big-title">Billet simple pour l'Alaska</h1>
            <h3 class="text-center font-weight-light sub-title">par<br/>Jean Forteroche</h3>
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
    <p class="text-center lead p-text">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <p class="text-center lead p-text">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <form class="form text-center mt-5" action="index.php?action=post&id=22" method="post">
        <input type="submit" class="btn btn-primary" value="Commencer la lecture"/>
    </form>
</section>
<?php
$content = ob_get_clean();

require('templateFront.php');