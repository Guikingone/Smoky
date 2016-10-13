<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Listener;

/**
 * Interface ModulesListenerInterfaces
 * @package Smoky\Modules\Listener
 */
interface ModulesListenerInterfaces
{
    /**
     * Allow to boot the Listener.
     */
    public function boot();

    /**
     * Stop the Listener.
     */
    public function stop();

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function getBootStatus();

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @param boolean $booted
     */
    public function setBootStatus($booted);
}