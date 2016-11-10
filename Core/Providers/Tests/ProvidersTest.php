<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core\Providers\Tests;

use PHPUnit\Framework\TestCase;
use Smoky\Providers\ModulesManagerProvider;

/**
 * Class ProvidersTest
 * @package Smoky\Core\Providers\Tests
 */
class ProvidersTest extends TestCase
{
    /**
     * Test if the ModulesManagerProvider can boot and load the classes.
     */
    public function testProviderBoot()
    {
        $modulesProvider = new ModulesManagerProvider();
        dump($modulesProvider);
    }
}