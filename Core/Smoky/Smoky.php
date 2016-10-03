<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core\Smoky;

use Symfony\Component\HttpKernel\HttpKernel;
use Core\Smoky\Router\Router;

/**
 * The Smoky framework class.
 *
 * @package Smoky
 */
class Smoky extends HttpKernel implements
      SmokyInterface
{
    public function getRoutes()
    {
        $router = new Router();
        $router->getRoutes();
    }
}