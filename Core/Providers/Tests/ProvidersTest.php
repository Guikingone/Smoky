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
        $provider = new MailerProvider();
        static::assertArrayHasKey('Mailer', $provider->getClasses());

        // Test if the ModulesProviders can boot twice.
        $provider->boot();
        static::assertTrue(true, $provider->getBootStatus());
    }

    /**
     * Test if the Provider can return a class using string research.
     */
    public function testProviderOutput()
    {
        $provider = new MailerProvider();
        $class = $provider->get('Mailer');
        static::assertClassHasAttribute('send', get_class($class));
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
