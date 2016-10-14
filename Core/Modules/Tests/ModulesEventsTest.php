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

use PHPUnit\Framework\TestCase;
use Smoky\Modules\Events\ModulesEvents;

class ModulesEventsTest extends TestCase
{
    /**
     * Test if the ModulesEvents can boot.
     */
    public function testModulesEventsBoot()
    {
        $moduleEvents = new ModulesEvents('AppModuleEvent', null, null);
        static::assertTrue(true, $moduleEvents->getBootStatus());
        static::assertEquals('AppModuleEvent', $moduleEvents->getName());
        static::assertNull(null, $moduleEvents->getTarget());
        static::assertNull(null, $moduleEvents->getParams());
    }

    /**
     * Test if the ModulesEvents contains data passed during the instantiation.
     */
    public function testModulesEventsInstantiation()
    {
        $modulesEvents = new ModulesEvents('onAppModule', ['onInit', 'onBoot'], ['onInitStatus']);
        static::assertTrue(true, $modulesEvents->getBootStatus());
        static::assertEquals('onAppModule', $modulesEvents->getName());
        static::assertContains('onInit', $modulesEvents->getTarget());
        static::assertContains('onInitStatus', $modulesEvents->getParams());
        static::assertContains(
            'onInitStatus', $modulesEvents->getParam(
                'onInitStatus', $modulesEvents->getParams()
            )
        );
    }

    /**
     * Test if the ModulesEvents can stop is propagation.
     */
    public function testModulesEventsStopPropagation()
    {
        $modulesEvents = new ModulesEvents('onAppModule', ['onInit'], ['onInitStatus']);
        $modulesEvents->stopPropagation();
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