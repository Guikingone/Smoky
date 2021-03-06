<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test\ModulesManagerTest;

use Smoky\Modules\Test\ModulesTest\AppModule;
use Smoky\Modules\Test\ModulesTest\UserModule;
use Smoky\Modules\ModulesManager\ModulesManager;

/**
 * Class MicroModulesManager
 * @package Smoky\Modules\Test\ModulesManagerTest
 */
class MicroModulesManager extends ModulesManager
{
    /** @inheritdoc */
    public function registerModules()
    {
        return [
            new AppModule(),
            new UserModule()
        ];
    }
}