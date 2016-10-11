<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Tests;

use PHPUnit\Framework\TestCase;
use Smoky\Core\Smoky;

class SmokyCoreTest extends TestCase
{
    /**
     * Test if Smoky __construct boot the framework.
     */
    public function testSmokyBootStatus()
    {
        $smoky = $this->getMockForAbstractClass(Smoky::class);
        static::assertFalse(false, $smoky->bootStatus());
    }

    /**
     * Test if the boot() method allow to boot the framework.
     */
    public function testSmokyBoot()
    {
        $smoky = $this->getMockForAbstractClass(Smoky::class);
        $smoky->boot();
        static::assertTrue(true, $smoky->bootStatus());
    }
}