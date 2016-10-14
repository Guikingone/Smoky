<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules;

/**
 * Interface ModulesInterfaces
 * @package Smoky\Modules
 */
interface ModulesInterfaces
{

    /**
     * Allow to boot the Module.
     *
     * [INFO]
     *
     * The method is called by the __constructor during every instantiation.
     */
    public function boot();

    /**
     * Allow to stop the Module.
     *
     * [WARNING]
     *
     * The method should be call only if the Module is attached to a Event who can block the execution
     * of a other Event.
     */
    public function stop();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function moduleStatus();
}