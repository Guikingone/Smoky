<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core\Providers;

/**
 * Interface ProviderInterface
 * @package Smoky\Core\Providers
 */
interface ProviderInterface
{
    /**
     * =================================================================================================================
     *  CORE METHODS
     * =================================================================================================================
     */

    /**
     * Allow to boot the Provider.
     */
    public function boot();

    /**
     * Allow to load every class into the Provider array.
     *
     * [INFO]
     *
     * This method is used by the "finale" class who extends Provider, this way, every key passed through the method is
     * "loaded" into the array using the register() method.
     *
     * [WARNING]
     *
     * This method should be called by every ---Provider class !
     */
    public function loadClasses();

    /**
     * Allow to register a new class into the Provider array.
     *
     * @param string $name
     * @param object $class
     *
     * @throws \LogicException    Only if the value passed aren't a string and a object.
     * @throws \LogicException    Only if two classes with the same name are found.
     */
    public function register($name, $class);

    /**
     * Allow to retrieve a class stored into the Provider array.
     *
     * @param string|object $name
     */
    public function get($name);

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param boolean $value
     */
    public function setBootStatus($value);

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /**
     * @return boolean
     */
    public function getBootStatus();
}