<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test;

use Smoky\Modules\Test\ModulesTest\AppModule;
use Smoky\ModulesManager\ModulesManager;

/**
 * Class MicroModulesManager
 * @package Smoky\Modules\Tests
 */
class MicroModulesManager extends ModulesManager
{
    /** @inheritdoc */
    public function registerModules()
    {
        $modules = [
            new AppModule(),
        ];

        return $modules;
    }
}