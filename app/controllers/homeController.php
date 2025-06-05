<?php
    namespace App\Controllers\HomeController;
    use \PDO;
    use \App\Models\MonstersModel;

    function homeAction(PDO $connexion){
        include '../app/models/monstersModel.php';
        $monsters = MonstersModel\findAll($connexion, 3);

        $allMonsters = MonstersModel\findAll($connexion);
        $totalMonsters = count($allMonsters);
        $randomNbr = random_int(1, $totalMonsters);
        $monster = MonstersModel\findOneById($connexion, $randomNbr);

        GLOBAL $content;
        GLOBAL $title;

        $title = 'Derniers monstres ajoutés';
        ob_start();
        include '../app/views/pages/home.php';
        $content = ob_get_clean();
    }