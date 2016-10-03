<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core\Smoky\Router;

use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    /** @var  RouteCollection */
    private $routes;

    public function findRoutes()
    {
        $location = new FileLocator(array(__DIR__ . '../../../app/routes'));
        $loader = new YamlFileLoader($location);
        $file = $loader->load('routes.yml');

        return $file;
    }

    public function addRoutes()
    {
        
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}