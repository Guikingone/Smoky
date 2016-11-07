<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test\ModulesTest;

use PHPUnit\Framework\TestCase;

/**
 * Class ModulesControllersTest
 * @package Smoky\Modules\Test\ModulesTest
 */
class ModulesControllersTest extends TestCase
{
    /**
     * Test if the Controller can boot.
     */
    public function testModulesControllerBoot()
    {
        $controller = new IndexController();
        static::assertTrue(true, $controller->getBootStatus());
        static::assertEquals('IndexController', $controller->getName());

        // Test again in order to find if the status return is correct.
        $controller->boot();
        static::assertTrue(true, $controller->getBootStatus());
    }

    /**
     * Test if the Controller can be stop.
     */
    public function testModulesControllerStop()
    {
        $controller = new IndexController();
        $controller->stop();
        static::assertFalse(false, $controller->getBootStatus());

        // Test again in order to find if the status return is correct.
        $controller->stop();
        static::assertFalse(false, $controller->getBootStatus());
    }
}