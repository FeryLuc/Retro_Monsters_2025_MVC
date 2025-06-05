<?php

namespace App\Controllers\MonstersController;
use \PDO;
use \App\Models\MonstersModel;

function indexAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $monsters = MonstersModel\findAll($connexion);

    GLOBAL $content;

    ob_start();
    include '../app/views/monsters/index.php';
    $content = ob_get_clean();
}