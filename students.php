<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

require __DIR__.'/../vendor/autoload.php';

$config = new Configuration();
$connectionParams = [
    'driver'    => 'pdo_mysql',
    'host'      => '127.0.0.1',
    'dbname'    => 'tp-sql',
    'user'      => 'root',
    'password'  => '',
    'charset'   => 'utf8mb4',
];

$conn = DriverManager::getConnection($connectionParams, $config);

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

echo "<h2>SELECT de plusieurs lignes</h2>",

$promotion_id = 3;

// créer une requête préparée à partir du code SQL et renvoie un pointeur sur le résultat
$students2 = $conn->executeQuery('SELECT students2.id, firstname, lastname, promotions.name FROM students2 INNER JOIN promotions ON students2.promotion_id = promotions.id WHERE students2.promotion_id = :promotion_id', [
    'promotion_id' => $promotion_id,
]);


// la méthode `rowCount()` permet de savoir combien de lignes le résultat comporte
echo 'results : '.$stmt->rowCount().'<br />';
echo '<br />';

// boucle `while` qui récupère les résultats ligne par ligne
while ($item = $stmt->fetch()) {
    // à chaque itération de la boucle, la variable `$item` contient une ligne de la table
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';
    echo $item['firstname'].'<br />';
    echo $item['lastname'].'<br />';
    echo $item['name'].'<br />';
    echo '<br />';
}


echo "<h2>SELECT d'une seule ligne</h2>",

$student_id=11;

// envoi d'une requête SQL à la BDD et récupération du premier résultat sous forme de tableau PHP dans la variable `$item`
$item = $conn->fetchAssoc('SELECT * FROM students WHERE id = :id', [
    'id' => $student_id,
]);

// affichage des données de chaque colonne
// chaque clé alpha-numérique représente une colonne de la table
echo $item['id'].'<br />';          // affichage de la colonne `id`
echo $item['firstname'].'<br />';        // affichage de la colonne `firstname`
echo $item['lastname'].'<br />';        // affichage de la colonne `lastname`
echo '<br />';
