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
use Smoky\Modules\Model\Module;

/**
 * Class ModulesTest
 * @package Smoky\Modules\Test
 */
class ModulesTest extends TestCase
{
    /**
     * Test if the Module boot and if the status of booted is changed.
     */
    public function testModuleBoot()
    {
        $module = new Module();
        static::assertTrue(true, $module->moduleStatus());
    }

    /**
     * Test if the Module is boot and if the sta
     */
    public function testModuleStop()
    {
        $module = new Module();
        $module->stop();
        static::assertFalse(false, $module->moduleStatus());
    }

    /**
     * Test the boot phase of the module and the name passed to this one.
     */
    public function testModuleName()
    {
        $module = new Module();
        $module->getName();
        static::assertEquals('Smoky\Modules\Model\Module', $module->getName());
    }
}