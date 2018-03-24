<?php

class NavPaginationView
{
    public function navLink($href, $current, $nbPage) {

        ob_start();
        ?>

        <nav class="mb-4" aria-label="navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($current == 1){echo 'disabled';}  ?>">
                    <a class="page-link" href="<?=$href?><?php if ($current != 1){echo $current-1;}else{echo $current;} ?>">Précédent</a>
                </li>

                <?php
                for($i=1; $i<=$nbPage; $i++){
                    if($i == $current){
                        ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?=$href?><?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="<?=$href?><?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="page-item <?php if ($current == $nbPage){echo 'disabled';} ?>">
                    <a class="page-link" href="<?=$href?><?php if ($current != $nbPage){echo $current+1;}else{echo $current;} ?>">Suivant</a>
                </li>
            </ul>
        </nav>

        <?php
        $navLink = ob_get_clean();

        return $navLink;
    }
}