<?php

namespace App\Controllers\MonstersController;
use \PDO;
use \App\Models\MonstersModel;

function indexAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $monsters = MonstersModel\findAll($connexion, 9);

    GLOBAL $content;

    ob_start();
    include '../app/views/monsters/index.php';
    $content = ob_get_clean();
}

function showAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $monster = MonstersModel\findOneById($connexion, $_GET['id']);

    GLOBAL $content;

    ob_start();
    include '../app/views/monsters/show.php';
    $content = ob_get_clean();
}