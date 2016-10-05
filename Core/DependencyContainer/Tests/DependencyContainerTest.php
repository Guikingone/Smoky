<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\DependencyContainer\Test;

use PHPUnit\Framework\TestCase;
use Smoky\DependencyContainer\DependencyContainer;

class DependencyContainerTest extends TestCase
{
    public function testDependencyContainerBoot()
    {
        $dependencyContainer = new DependencyContainer();
        $dependencyContainer->register('listener.router');
        static::assertArrayHasKey('listener.router', $dependencyContainer->getDefinitions());
    }
}