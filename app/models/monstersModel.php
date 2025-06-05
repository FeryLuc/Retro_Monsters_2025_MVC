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

function findByName(PDO $connexion, string $texte) {
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id 
            WHERE monsters.name LIKE :texte
            ORDER BY monsters.created_at DESC';
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':texte', '%' . $texte . '%', PDO::PARAM_STR);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findByFilters(PDO $connexion, $type, $rarity, $min_pv, $max_pv, $min_attaque, $max_attaque){

    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name FROM monsters JOIN monster_types ON monster_types.id = monsters.type_id WHERE 1=1';
    $params = [];
//  var_dump($type, $rarity, $min_pv, $max_pv, $min_attaque,$max_attaque); exit;
    if ($type) {
        $sql .= ' AND monster_types.name = :type';
        $params[':type'] = $type;
    }
    if ($rarity) {
        $sql .= ' AND monsters.rarity = :rarity';
        $params[':rarity'] = $rarity;
    }
    if ($min_pv !== null && $min_pv !== '') {
        $sql .= ' AND monsters.pv >= :min_pv';
        $params[':min_pv'] = (int)$min_pv;
    }
    if ($max_pv !== null && $max_pv !== '') {
        $sql .= ' AND monsters.pv <= :max_pv';
        $params[':max_pv'] = (int)$max_pv;
    }
    if ($min_attaque !== null && $min_attaque !== '') {
        $sql .= ' AND monsters.attack >= :min_attaque';
        $params[':min_attaque'] = (int)$min_attaque;
    }
    if ($max_attaque !== null && $max_attaque !== '') {
        $sql .= ' AND monsters.attack <= :max_attaque';
        $params[':max_attaque'] = (int)$max_attaque;
    }
    $sql .= ' ORDER BY monsters.created_at DESC';
    $rs = $connexion->prepare($sql);
    foreach ($params as $key => $value) {
        $rs->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
// echo $sql;
// print_r($params);
// exit;
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
function addOneMonster(PDO $connexion){

}