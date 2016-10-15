<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Model;
use Smoky\Modules\Controllers\ControllerInterfaces;

/**
 * Interface ModulesInterfaces
 * @package Smoky\Modules\ModulesManager
 */
interface ModulesInterfaces
{
    /**
     * =================================================================================================================
     *  CORE METHODS
     * =================================================================================================================
     */

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
     * Allow to load every Controllers stored into the Module.
     *
     * [INFO]
     *
     * This method is call automatically by the instantiation of the Module, every Controller are stored into the
     * Modules->controllers[].
     *
     * @throws \LogicException    Only if two Controller with the same name are find.
     */
    public function loadControllers();

    /**
     * Register all the Controllers into an array.
     *
     * [WARNING]
     *
     * This method should only be used by the ---Module.php class present in every Module.
     *
     * [INFO]
     *
     * This method allow to register Controllers into the array of the Module, by this method, the Module can store
     * the Controller and load him into.
     */
    public function registerControllers();

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /**
     * @return string    The name of the Module.
     */
    public function getName();

    /**
     * @return boolean    The status of the Module.
     */
    public function getModuleStatus();

    /**
     * @return ControllerInterfaces[]    The Controllers stored into the Module.
     */
    public function getControllers();

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param boolean $booted
     */
    public function setBootStatus($booted);
}