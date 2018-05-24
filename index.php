<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

require __DIR__.'/../vendor/autoload.php';

$config = new Configuration();
$connectionParams = [
    'driver'    => 'pdo_mysql',
    'host'      => '127.0.0.1',
    'dbname'    => 'doctrine',
    'user'      => 'root',
    'password'  => '',
    'charset'   => 'utf8mb4',
];
$conn = DriverManager::getConnection($connectionParams, $config);

// récupération de tous les éléments de la table `item` dans un tableau PHP
$items = $conn->fetchAll('SELECT * FROM todo');

foreach ($items as $item) {
    echo $item['id'].'<br />';
    echo $item['name'].'<br />';
    echo $item['deadline'].'<br />';
    echo $item['done'].'<br />';
    echo $item['description'].'<br />';
    echo '<br />';
}

// récupération de tous les éléments de la table `item` dans un tableau PHP
$Students = $conn->fetchAll('SELECT * FROM students');


foreach ($Students as $student) {
    echo $student['id'].'<br />';
    echo $student['firstname'].'<br />';
    echo $student['lastname'].'<br />';
    echo $student['birthdate'].'<br />';
    echo $student['promotion_id'].'<br />';
    echo $student['sex'].'<br />';
    echo '<br />';
}
