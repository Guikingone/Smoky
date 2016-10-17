<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test\ModulesTest;

use Smoky\Modules\Module\Module;

/**
 * Class AppModule
 * @package Smoky\Modules\Test\ModulesTest
 */
class AppModule extends Module
{
    public function registerControllers()
    {
        $controllers = [
            new IndexController()
        ];

        return $controllers;
    }
}