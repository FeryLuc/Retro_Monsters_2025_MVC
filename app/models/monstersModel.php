<?php

namespace App\Models\MonstersModel;
use \PDO;

function findAll(PDO $connexion, ?int $limit = null){
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name FROM monsters JOIN monster_types ON monster_types.id = monsters.type_id ORDER BY monsters.created_at DESC';
    if ($limit !== null) {
        $sql .= ' LIMIT :limit';
    }
    $rs = $connexion->prepare($sql);
    if ($limit !== null) {
        $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    $rs->execute();
    $monsters = $rs->fetchAll(PDO::FETCH_ASSOC);
    return $monsters;
}

function findOneById(PDO $connexion, int $id){
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name FROM monsters JOIN monster_types ON monster_types.id = monsters.type_id WHERE monsters.id = :id;';
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();
    $monster = $rs->fetch(PDO::FETCH_ASSOC);
    return $monster;
}

function addOneMonster(PDO $connexion){
    
}