<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Provider;

/**
 * Interface ProviderInterface
 * @package Smoky\Provider
 */
interface ProviderInterface
{
    /**
     * Allow to register a new class into the Provider array.
     *
     * @param string $name
     * @param object $class
     */
    public function register($name, $class);

    /**
     * Allow to retrieve a class stored into the Provider array.
     *
     * @param string|object $name
     */
    public function get($name);
}