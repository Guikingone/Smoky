<?php

require_once __DIR__.'/../app/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/'      => __DIR__ .'/views/hello.php',
    '/bye'   => __DIR__ . '/views/night.php'
];

$path = $request->getPathInfo();
if (array_key_exists($path, $map)) {
    ob_start();
    include $map[$path];
    $response->setContent(ob_get_clean());
} else {
    $response->setStatusCode(404);
    $response->setContent('Vous ne passerez pas !');
}

$response->send();
