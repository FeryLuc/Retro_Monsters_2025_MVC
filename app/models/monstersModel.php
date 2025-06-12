<?php

namespace App\Models\MonstersModel;
use \PDO;

function findAll(PDO $connexion, ?int $limit = null, int $offset = 0){
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id ORDER BY monsters.created_at DESC';
    if ($limit !== null) {
        $sql .= ' LIMIT :limit OFFSET :offset';
    }
    $rs = $connexion->prepare($sql);
    if ($limit !== null) {
        $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
        $rs->bindValue(':offset', $offset, PDO::PARAM_INT);
    }
    $rs->execute();
    $monsters = $rs->fetchAll(PDO::FETCH_ASSOC);
    return $monsters;
}

function findOneById(PDO $connexion, int $id){
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id WHERE monsters.id = :id;';
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();
    $monster = $rs->fetch(PDO::FETCH_ASSOC);
    return $monster;
}

function findOneByRand(PDO $connexion){
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id ORDER BY RAND() LIMIT 1';
    $rs = $connexion->query($sql);
    return $rs->fetch(PDO::FETCH_ASSOC);
}
//Classique recherche.
// function findByText(PDO $connexion, string $texte) {
//     $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
//             FROM monsters 
//             JOIN monster_types ON monster_types.id = monsters.type_id 
//             WHERE monsters.name LIKE :texte
//             ORDER BY monsters.created_at DESC';
//     $rs = $connexion->prepare($sql);
//     $rs->bindValue(':texte', '%' . $texte . '%', PDO::PARAM_STR);
//     $rs->execute();
//     return $rs->fetchAll(PDO::FETCH_ASSOC);
// }
function findByText(PDO $connexion, string $texte) {
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id 
            WHERE 1=1';

    $params = [];
    //Split sur tout ce qui est un espace entre les mots
    $mots = preg_split('/\s+/', trim($texte));
    //Pour chaque mot dans le tableau on construit notre requete en créant dans le tabeau params les clé-valeur (:mot0 = un mot (préparer pour la recherche))
    foreach($mots as $index => $mot){
        $sql .= " AND (monsters.name LIKE :mot{$index} OR monsters.description LIKE :mot{$index} OR monsters.rarity LIKE :mot{$index})";
        $params[":mot{$index}"] = '%'.$mot.'%';
    }
    $sql .= ' ORDER BY monsters.created_at DESC;';
    $rs = $connexion->prepare($sql);
    //on bind chaque :mot à leur valeur %..%
    foreach($params as $key => $value){
        $rs->bindValue($key, $value, PDO::PARAM_STR);
    }
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findByFilters(PDO $connexion, ?string $type, ?string $rarity, ?int $min_pv, ?int $max_pv, ?int $min_attaque, ?int $max_attaque){
// Where 1=1 est une astuce sql. étant toujours vraie elle permet d'accumuler les AND sans se soucier de la syntaxe de la première condition (WHERE AND)
    $sql = 'SELECT *, monsters.id AS monsterId, monsters.name AS monster_name, monster_types.name AS type_name 
            FROM monsters 
            JOIN monster_types ON monster_types.id = monsters.type_id WHERE 1=1';
    $params = [];
//  var_dump($type, $rarity, $min_pv, $max_pv, $min_attaque,    $max_attaque); exit;
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
// compter les monstres
function countAll(PDO $connexion) {
    $sql = 'SELECT COUNT(*) FROM monsters';
    return $connexion->query($sql)->fetchColumn();
}
function addOneMonster(PDO $connexion){

}