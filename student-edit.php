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

$id = !empty($_GET['id']) ? $_GET['id'] : 0;
$student = $conn->fetchAssoc('SELECT * FROM students2 WHERE id = :id', [
    'id' => $id,
]);
$promotions = $conn ->fetchAll('SELECT * FROM promotions');

$sexes = [
   [ "id" => 0,
    "type" => "homme"
    ],
 [ "id" => 1,
  "type" => "femme"
]];

echo $twig->render('student-edit.html.twig',[
  'student' => $student,
  'promotions' => $promotions,
  'sexes' => $sexes,
]);
