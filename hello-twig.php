<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader, [
    'cache' => __DIR__.'/../var/cache',
]);

$greeting = 'Hello Twig!';
$isAdmin = false;

$template = $twig->load('hello-twig.html.twig');
echo $template->render([
    'greeting' => $greeting,
]);
