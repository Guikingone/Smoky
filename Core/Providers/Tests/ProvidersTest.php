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

/**
 * Class ProvidersTest.
 */
class ProvidersTest extends TestCase
{
    /**
     * Test if the ModulesManagerProvider can boot and load the classes.
     */
    public function testProviderBoot()
    {
        $modulesProvider = new MailerProvider();

        // Test if the ModulesProviders can boot twice.
        $modulesProvider->boot();
        static::assertTrue(true, $modulesProvider->getBootStatus());
        dump($modulesProvider);
    }

    /**
     * Test if the Provider can contains the key passed within the loadClasses() method.
     */
    public function testProviderContains()
    {
        $provider = new MailerProvider();
        static::assertArrayHasKey('Mailer', $provider->getClasses());
    }

    /**
     * Test if the Provider can be stopped.
     */
    public function testProviderStop()
    {
        $provider = new MailerProvider();
        $provider->stop();
        static::assertFalse(false, $provider->getBootStatus());

        // Test if the Provider can stop twice in a row.
        $provider->stop();
        static::assertFalse(false, $provider->getBootStatus());
    }
}