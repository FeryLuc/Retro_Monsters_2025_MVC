<?php
use \App\Controllers\HomeController;
use \App\Controllers\AddMonsterController;


if(isset($_GET['monsters'])):
    include_once '../app/routers/monsters.php';
// addMonster concerne l'ajout d'un monstre, est-ce mieux de passer par une route indépendante comme la page home avec ou sans sous routeur adéquat ou passer dans le sous routeur monsters?
elseif(isset($_GET['addMonster'])):
    include_once '../app/Controllers/addMonsterController.php';
    AddMonsterController\addMonsterAction($connexion);
else:
    include_once '../app/controllers/homeController.php';
    HomeController\homeAction($connexion);
endif;