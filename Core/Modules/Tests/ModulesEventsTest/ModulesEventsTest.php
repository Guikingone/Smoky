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
    }

    /**
     * Test if the ModulesEvents can stop is propagation.
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
    }
}