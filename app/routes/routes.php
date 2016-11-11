<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('hello', new Route('/{name}', array(
    'name' => '',
    '_controller' => 'AppModule\\Controller\\IndexController::indexAction', )));

$routes->add('night', new Route('/bye/{name}', array(
    'name' => '',
    '_controller' => 'AppModule\\Controller\\IndexController::byeAction', )));

return $routes;
