<?php

$head_title = 'Billet simple pour l\'Alaska';

$homeActive = 'active';



ob_start();
?>

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
?>
<section class="my-5">
    <p class="text-center lead p-text">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <p class="text-center lead p-text">Lorem ipsum dolor sit amet consectetuer adipiscing elit. Id fames orci est rhoncus hac cubilia erat et suscipit
        integer aenean metus egestas. Potenti nec adipiscing. Augue amet a neque proin vitae cursus risus dictum primis
        lobortis id nullam facilisi sit. Euismod potenti sed sagittis adipiscing.</p>

    <form class="form text-center mt-5" action="index.php?action=chapter&amp;id=22" method="post">
        <input type="submit" class="btn btn-info" value="Commencer la lecture"/>
    </form>
</section>
<?php
$content = ob_get_clean();

require('templateFront.php');