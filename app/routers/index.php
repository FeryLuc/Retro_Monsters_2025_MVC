<?php

if(isset($_GET['monsters'])):
    include_once '../app/routers/monsters.php';
elseif(isset($_GET['addMonster'])):
    include_once '../app/routers/addMonster.php';
else:
    ob_start();
    include '../app/views/pages/home.php';
    $content = ob_get_clean();
endif;