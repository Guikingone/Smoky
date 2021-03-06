<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Tests\ModulesManagerTest;

use PHPUnit\Framework\TestCase;
use Smoky\Modules\Test\ModulesManagerTest\MicroModulesManager;

/**
 * Class ModulesManagerTest
 * @package Smoky\Modules\Tests\ModulesManagerTest
 */
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
        $modulesManager = new MicroModulesManager();
        static::assertArrayHasKey('AppModule', $modulesManager->getModules());
        static::assertArrayHasKey('UserModule', $modulesManager->getModules());
        static::assertTrue(true, $modulesManager->getLoadStatus());
    }

    /**
     * Test if the ModulesManager load Modules and inject him in the ModulesInterfaces[] array, after this, the method
     * addEvents is called and add a new Events linked to every Modules.
     */
    public function testModulesManagerModulesEvents()
    {
        $modulesManager = new MicroModulesManager();
        static::assertArrayHasKey(
            'AppModuleEvent', $modulesManager->getEvents()
        );
        static::assertArrayHasKey(
            'UserModuleEvent', $modulesManager->getEvents()
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
            'AppModuleListener', $modulesManager->getListeners()
        );
        static::assertArrayHasKey(
            'UserModuleListener', $modulesManager->getListeners()
        );
    }

    /**
     * Test if the ModulesManager can clean his array of Events and Listeners.
     */
    public function testModulesManagerClear()
    {
        $modulesManager = new MicroModulesManager();
        $modulesManager->clearEvents();
        $modulesManager->clearListeners();
        static::assertArrayNotHasKey(
            'AppModuleEvent', $modulesManager->getEvents()
        );
        static::assertArrayNotHasKey(
            'UserModuleEvent', $modulesManager->getEvents()
        );
        static::assertArrayNotHasKey(
            'AppModuleListener', $modulesManager->getListeners()
        );
        static::assertArrayNotHasKey(
            'UserModuleListener', $modulesManager->getListeners()
        );
    }

    /**
     * Test if the ModulesManager can be stopped.
     */
    public function testModulesManagerStop()
    {
        $modulesManager = new MicroModulesManager();
        $modulesManager->stop();
        static::assertFalse(false, $modulesManager->getBootStatus());
    }
}