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
use Smoky\Modules\Listener\ModulesListener;

class ModulesListenerTest extends TestCase
{
    /**
     * Test if the Listener is boot.
     */
    public function testModulesListenerBoot()
    {
        $listener = new ModulesListener('onControllerEvent');
        static::assertTrue(true, $listener->getBootStatus());
        static::assertEquals('onControllerEvent', $listener->getName());
    }
}