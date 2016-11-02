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
 * Class ModulesTest
 * @package Smoky\Modules\Test\ModulesTest
 */
class ModulesTest extends TestCase
{
    /**
     * Test if the Module boot and if the status of booted is changed.
     */
    public function testModuleBoot()
    {
        $module = new AppModule();
        static::assertTrue(true, $module->getModuleStatus());
        static::assertEquals('AppModule', $module->getName());
    }

    /**
     * Test if the configurations are loaded correctly.
     */
    public function testModuleLoadingConfig()
    {
        $module = new AppModule();
        static::assertFalse(false, $module->isLazy());
        static::assertArrayHasKey('Index', $module->getControllers());
        static::assertArrayHasKey('Article', $module->getEntities());
        static::assertArrayHasKey('ArticleRepository', $module->getRepositories());
    }

    /**
     * Test if the Module can be stop and if the status change after the stop call.
     */
    public function testModuleStop()
    {
        $module = new AppModule();
        $module->stop();
        static::assertFalse(false, $module->getModuleStatus());
    }
}