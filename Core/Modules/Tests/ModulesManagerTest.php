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

class ModulesManagerTest extends TestCase
{
    /**
     * Test if the ModulesManager boot.
     */
    public function testModulesManagerBoot()
    {
        $modulesManager = new MicroModulesManager();
        static::assertTrue(true, $modulesManager->getBootStatus());
        static::assertArrayHasKey('onInit', $modulesManager->getKeys());
        static::assertArrayHasKey('onBoot', $modulesManager->getKeys());
        static::assertArrayHasKey('onCall', $modulesManager->getKeys());
        static::assertArrayHasKey('onLaunch', $modulesManager->getKeys());
    }

    /**
     * Test if the ModulesManager load Modules and inject him into the ModulesInterfaces[] array.
     */
    public function testModulesManagerModulesLoading()
    {
        $modulesManger = new MicroModulesManager();
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
        static::assertArrayHasKey(
            'onInit', $modulesManager->getEvents()
        );
        static::assertArrayHasKey(
            'onBoot', $modulesManager->getEvents()
        );
        static::assertArrayHasKey(
            'onCall', $modulesManager->getEvents()
        );
        static::assertArrayHasKey(
            'onLaunch', $modulesManager->getEvents()
        );
    }

    /**
     * Test if the ModulesManager load Modules and inject him in the ModulesInterfaces[] array, after this, the method
     * addListeners is called and add a new Listener linked to every Modules.
     */
    public function testModulesManagerModulesListeners()
    {
        $modulesManager = new MicroModulesManager();
        static::assertArrayHasKey(
            'onInit', $modulesManager->getListeners()
        );
        static::assertArrayHasKey(
            'onBoot', $modulesManager->getListeners()
        );
        static::assertArrayHasKey(
            'onCall', $modulesManager->getListeners()
        );
        static::assertArrayHasKey(
            'onLaunch', $modulesManager->getListeners()
        );
    }
}