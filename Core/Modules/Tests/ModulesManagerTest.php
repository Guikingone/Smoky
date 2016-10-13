<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Tests;

use PHPUnit\Framework\TestCase;
use Smoky\Modules\Test\MicroModulesManager;
use Smoky\Modules\Test\ModulesTest\AppModule;

class ModulesManagerTest extends TestCase
{
    /**
     * Test if the ModulesManager boot.
     */
    public function testModulesManagerBoot()
    {
        $modulesManager = new MicroModulesManager();
        static::assertTrue(true, $modulesManager->getBootStatus());
    }

    /**
     * Test if the ModulesManager load Modules and inject him into the ModulesInterfaces[] array.
     */
    public function testModulesManagerModulesLoading()
    {
        $modulesManger = new MicroModulesManager();
        $modulesManger->loadModules();
        static::assertArrayHasKey('Smoky\Modules\Test\ModulesTest\AppModule', $modulesManger->getModules());
        static::assertTrue(true, $modulesManger->getLoadStatus());
    }

    /**
     * Test if the ModulesManager load Modules and inject him in the ModulesInterfaces[] array, after this, the method
     * addEvents is called and add a new Events linked to every Modules.
     */
    public function testModulesManagerModulesEvents()
    {
        $modulesManager = new MicroModulesManager();
        $modulesManager->loadModules();
        static::assertArrayHasKey(
            'Smoky\Modules\Test\ModulesTest\AppModuleEvent', $modulesManager->getEvents()
        );
    }

    public function testModulesManagerModulesSingleEvents()
    {
        $modulesManager = new MicroModulesManager();
        $modulesManager->loadModules();
        $modulesManager->addListener();
        static::assertArrayHasKey(
            'Smoky\Modules\Test\ModulesTest\AppModuleEventListener', $modulesManager->getListeners()
        );
    }
}