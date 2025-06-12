<?php

include_once '../app/controllers/monstersController.php';
use \App\Controllers\MonstersController;


    switch ($_GET['monsters']) {
        case 'show':
            MonstersController\showAction($connexion);
            break;
        case 'text':
            MonstersController\searchAction($connexion);
            break;
        case 'filter':
            MonstersController\filterAction($connexion);
            break;
        default:
            MonstersController\indexAction($connexion);
            break;
    }
