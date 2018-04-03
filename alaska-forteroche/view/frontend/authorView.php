<?php

$head_title = 'L\'auteur';

$authorActive = 'active';

$headerHome = null;

ob_start();
?>

<header class="headerPost container-fluid">
    <div class="row h-100">
        <div class="titleBackChapter mx-auto my-auto">
            <h1 class="text-center display-3 big-title-post">L'auteur</h1>
        </div>
    </div>
</header>

<?php

$headerRest= ob_get_clean();

ob_start();
?>

<section class="my-5">
    <h1 class="text-center mb-5">Jean Forteroche</h1>
    <div style="max-width: 500px;" class="mx-auto mx-lg-0">
        <img class="rounded float-lg-left mr-4 img-thumbnail img-fluid" style="max-width: 100%; height: auto;" src="public/imgs/portrait-2068038_640.jpg">
    </div>
    <div class="my-5">

        <p class="blockquote p-text text-justify">Né à Paris le 13 janvier 1972 à Paris d'une mère française et d'un père américain.
            Il passera ainsi la majeure partie de son enfance entre Paris et Anchorage en Alaska où son père fait fortune
            dans le domaine pétrolier.
        </p>
        <p class="blockquote p-text text-justify">
            À 20 ans, il décide de se consacrer au théâtre. Après plusieurs années d'études à la prestigieuse université
            de Caroline du Sud, il joue dans plusieurs pièces à Paris avant de s'essayer au cinéma dans le film "Comme un
            Lundi" de Peter Murich.Premier essai, coup de maître. Son interprétation sera récompensée par un César
            et une Palme d'or.
        </p>
        <p class="blockquote p-text text-justify">
            Sa carrière d'acteur lancée, il enchaîne les rôles et commence conjointement une prolixe carrière d'écrivain.
            Il publie plusieurs romans policiers avant d'écrire une oeuvre plus personnelle sur sa relation avec son père.
            Ce roman "Une année de plus" remportera le prix Goncourt en 2009.
        </p>
        <p class="blockquote p-text text-justify">
            Aujourd'hui, Jean Forteroche vit en Bretagne avec sa femme et ses quatre enfants et se consacre entièrement
            à l'écriture.
        </p>
    </div>
</section>

<?php $content= ob_get_clean();

require('templateFront.php');