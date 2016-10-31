<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Test;

use PHPUnit\Framework\TestCase;

/**
 * Class SmokyCoreTest
 * @package Smoky\Test
 */
class SmokyCoreTest extends TestCase
{
    /**
     * Test if Smoky __construct boot the framework.
     */
    public function testSmokyBootStatus()
    {
        $smoky = new MicroSmoky('dev', true);
        static::assertFalse(false, $smoky->bootStatus());
        static::assertTrue(true, $smoky->debugStatus());
        static::assertEquals('dev', $smoky->getEnvironment());
    }

    /**
     * Test if the process of launching a request is initialized.
     */
    public function testSmokyLaunch()
    {
        $smoky = new MicroSmoky('dev', true);
        $smoky->launch();
        static::assertTrue(true, $smoky->bootStatus());
        static::assertArrayHasKey('kernel', $smoky->getDefinitions());
        static::assertArrayNotHasKey('Smoky\Test\Modules\AppModules', $smoky->getModules());
    }

    /**
     * Test if the framework can stop the execution in dev mode.
     */
    public function testSmokyShutdown()
    {
        $smoky = new MicroSmoky('dev', true);
        $smoky->shutdown();
        static::assertTrue(true, $smoky->bootStatus());
    }
}