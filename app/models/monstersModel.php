<?php

namespace App\Models\MonstersModel;
use \PDO;

function findAll(PDO $connexion, int $limit = 9){
    $sql = 'SELECT *, monsters.name AS monster_name, monster_types.name AS type_name FROM monsters JOIN monster_types ON monster_types.id = monsters.type_id LIMIT :limit;';
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    $monsters = $rs->fetchAll(PDO::FETCH_ASSOC);
    return $monsters;
}