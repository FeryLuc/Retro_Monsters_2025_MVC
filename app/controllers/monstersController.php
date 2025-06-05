<?php

namespace App\Controllers\MonstersController;
use \PDO;
use \App\Models\MonstersModel;

function indexAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $monsters = MonstersModel\findAll($connexion, 9);

    GLOBAL $content;
    GLOBAL $title;

    $title = 'Derniers monstres ajoutés';
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

function searchAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $inputValue = $_GET['texte'] ?? '';
    $monsters = MonstersModel\findByName($connexion, $inputValue);

    GLOBAL $content;
    GLOBAL $title;

    $title = 'Résultat de la recherche';
    ob_start();
    include '../app/views/monsters/index.php';
    $content = ob_get_clean();
}

function filterAction(PDO $connexion){
    include '../app/models/monstersModel.php';
    $type = $_GET['type'] ?? null;
    $rarity = $_GET['rarity'] ?? null;
    $min_pv = $_GET['min_pv'] ?? null;
    $max_pv = $_GET['max_pv'] ?? null;
    $min_attaque = $_GET['min_attaque'] ?? null;
    $max_attaque = $_GET['max_attaque'] ?? null;

    $monsters = MonstersModel\findByFilters($connexion, $type, $rarity, $min_pv, $max_pv, $min_attaque, $max_attaque);


    GLOBAL $content;
    GLOBAL $title;

    $title = 'Résultat des filtres';
    ob_start();
    include '../app/views/monsters/index.php';
    $content = ob_get_clean();
}