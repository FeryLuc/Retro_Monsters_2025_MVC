<?php
namespace App\Controllers\AddMonsterController;
use \PDO;
use \App\Models\MonstersModel;

function addMonsterAction(PDO $connexion){
    include '../app/models/monstersModel.php';

    GLOBAL $content;

    ob_start();
    include '../app/views/pages/addMonster.php';
    $content = ob_get_clean();

}