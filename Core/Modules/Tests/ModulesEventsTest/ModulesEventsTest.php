<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test\ModulesEventsTest;

use PHPUnit\Framework\TestCase;
use Smoky\Modules\Events\ModulesEvents;
use Smoky\Modules\Test\ModulesTest\AppModule;

/**
 * Class ModulesEventsTest
 * @package Smoky\Modules\Test\ModulesEventsTest
 */
class ModulesEventsTest extends TestCase
{
    /**
     * Test if the ModulesEvents can boot and if the data are correctly set.
     */
    public function testModulesEventsBoot()
    {
        $moduleEvents = new ModulesEvents('AppModuleEvent', 'onInit', ['onInit', 'onBoot']);
        static::assertTrue(true, $moduleEvents->getBootStatus());
        static::assertEquals('AppModuleEvent', $moduleEvents->getName());
        static::assertEquals('onInit', $moduleEvents->getTarget());
        static::assertContains('onInit', $moduleEvents->getParams());
        static::assertContains('onBoot', $moduleEvents->getParams());
        static::assertFalse(false, $moduleEvents->isPropagationStopped());

        // Test again in order to find if the status return is correct.
        $moduleEvents->boot();
        static::assertTrue(true, $moduleEvents->getBootStatus());
    }

    /**
     * Test if the ModulesEvents contains data passed during the instantiation.
     */
    public function testModulesEventsInstantiation()
    {
        $modulesEvents = new ModulesEvents('onAppModule', 'onBoot', ['onInitStatus']);
        static::assertTrue(true, $modulesEvents->getBootStatus());
        static::assertEquals('onAppModule', $modulesEvents->getName());
        static::assertContains('onBoot', $modulesEvents->getTarget());
        static::assertContains('onInitStatus', $modulesEvents->getParams());
        static::assertNull(null, $modulesEvents->getParam('onInitStatus'));
    }

    /**
     * Test if the parameters array can contains a key and the values linked.
     */
    public function testModulesEventParameters()
    {
        $modulesEvents = new ModulesEvents('AppModuleEvent', 'onCall', ['onCall' => 'onCall']);
        static::assertArrayHasKey('onCall', $modulesEvents->getParams());
        static::assertContains('onCall', $modulesEvents->getParam('onCall'));

        // Test if object can be passed through the parameters array.
        $modulesEvents->setParams([AppModule::class => AppModule::class]);
        static::assertArrayHasKey(AppModule::class, $modulesEvents->getParams());
        static::assertContains(AppModule::class, $modulesEvents->getParam(AppModule::class));
    }

    /**
     * Test if the ModulesEvents can stop his propagation.
     */
    public function testModulesEventsStopPropagation()
    {
        $modulesEvents = new ModulesEvents('onAppModule', ['onInit'], ['onInitStatus']);
        $modulesEvents->stopPropagation(true);
        static::assertTrue(true, $modulesEvents->isPropagationStopped());
    }

    /**
     * Test if the ModulesEvents can be stopped.
     */
    public function testModulesEventsStop()
    {
        $modulesEvents = new ModulesEvents('onAppModule', null, null);
        $modulesEvents->stop();
        static::assertFalse(false, $modulesEvents->getBootStatus());

        // Test again in order to find if the status return is correct.
        $modulesEvents->stop();
        static::assertFalse(false, $modulesEvents->getBootStatus());
    }
}