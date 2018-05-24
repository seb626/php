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




// créer une requête préparée à partir du code SQL et renvoie un pointeur sur le résultat
$students2 = $conn->executeQuery('SELECT students2.id, firstname, lastname, promotions.name FROM students2 INNER JOIN promotions ON students2.promotion_id = promotions.id');

echo $twig->render('students2.html.twig', [
  'students2' => $students2,
]);
