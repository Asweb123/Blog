<?php

$head_title = 'Billet simple pour l\'Alaska';

$homeActive = 'active';



ob_start();
?>

<header class="container-fluid headerHome">
    <div class="row h-100 headerFilter">
        <div class="titleBack mx-auto my-auto">
            <h1 class="text-center display-3 mb-4 big-title">Billet simple pour l'Alaska</h1>
            <h3 class="text-center font-weight-light sub-title">Le nouveau roman de Jean Forteroche</h3>
        </div>
        <div class="faCentered"><a href="#scrollDown"><i class="fa fa-chevron-down arrow"></i></a></div>
    </div>
    <div id="scrollDown"></div>
</header>

<?php
$headerHome = ob_get_clean();

$headerRest = null;


ob_start();
?>
<section class="my-5">

    <h1 class="text-center display-4 my-5 px-4 slog">
        Découvrez le nouveau roman de Jean Forteroche publié en ligne au fil de son écriture.
    </h1>

    <blockquote class="blockquote text-center p-text my-5">
        <p>
            "Marc regarde une dernière fois la vue de son luxueux appartement parisien. Une vue comme on n'en voit que sur
            les cartes postales ou dans les films bourrés de clichés sur la capitale.
            <br/>
            Marc a tout. Ou du moins tout ce que dont rêvent la plupart des gens. Pourtant, contemplant une dernière fois
            ce symbole de son statut social, il sait que demain, cette vie de nanti qu'il a mené toute sa vie ne sera plus
            que du passé. Il pourrait être mélancolique de cette existence qu'il s'apprêtte à laisser derrière lui ou
            exalté à l'idée de ce qu'il compte accomplir. Pourtant, en cette étouffante fin de soirée estivale, Marc ne
            ressent rien. Il contemple juste une dernière fois sans réellement savoir pourquoi cette vue si familière.
            Demain, tout ce qu'il verra sera nouveau pour lui. Et tout ce qu'il possédera ne sera plus contenu que dans
            un simple sac à dos..."
        </p>
        <footer class="blockquote-footer">Extrait de l'oeuvre <cite title="Billet simple pour l'Alaska">Billet simple pour l'Alaska</cite></footer>
    </blockquote>

    <img src="public/imgs/man-3065475_1280.jpg" class="picMarc img-thumbnail">







    <p class="text-center blockquote p-text mt-5 p-1">
        Suivez Marc à travers l'immensité des paysages de l'Alaska et laissez vous emporter
        par la plume de Jean Forteroche jusque dans les plus profondes pensées d'un homme à qui la vie avait pourtant tout donné...
    </p>



    <form class="form text-center mt-5" action="index.php?action=allChapter&amp;p=1" method="post">
        <input type="submit" class="btn btn-info" value="Commencer la lecture"/>
    </form>

</section>

<?php
$content = ob_get_clean();

require('templateFront.php');
