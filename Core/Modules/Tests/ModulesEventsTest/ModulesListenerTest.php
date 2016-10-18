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
use Smoky\Modules\Listener\ModulesListener;

/**
 * Class ModulesListenerTest
 * @package Smoky\Modules\Test\ModulesEventsTest
 */
class ModulesListenerTest extends TestCase
{
    /**
     * Test if the ModuleListener is boot.
     */
    public function testModulesListenerBoot()
    {
        $listener = new ModulesListener('onControllerEvent');
        static::assertTrue(true, $listener->getBootStatus());
        static::assertEquals('onControllerEvent', $listener->getName());
    }

    /**
     * Test if the ModulesListeners can be stopped.
     */
    public function testModulesListenerStop()
    {
        $listener = new ModulesListener('AppModuleListener');
        $listener->stop();
        static::assertFalse(false, $listener->getBootStatus());
    }
}