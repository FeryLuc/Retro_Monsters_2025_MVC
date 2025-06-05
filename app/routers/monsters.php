<?php

include_once '../app/controllers/monstersController.php';
use \App\Controllers\MonstersController;

switch ($_GET['monsters']) {
    case 'show':
        
        break;
    
    default:
        MonstersController\indexAction($connexion);
        break;
}