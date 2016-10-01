<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('hello', new Route('/{name}', array('name' => '')));
$routes->add('night', new Route('/bye/{name}', array('name' => '')));

return $routes;