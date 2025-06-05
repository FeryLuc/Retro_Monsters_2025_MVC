<?php
use \App\Controllers\HomeController;
use \App\Controllers\AddMonsterController;

if(isset($_GET['monsters'])):
    include_once '../app/routers/monsters.php';
elseif(isset($_GET['addMonster'])):
    include_once '../app/Controllers/addMonsterController.php';
    AddMonsterController\addMonsterAction($connexion);
else:
    include '../app/controllers/homeController.php';
    HomeController\homeAction($connexion);
endif;