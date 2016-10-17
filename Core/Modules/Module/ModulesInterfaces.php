<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Module;
use Smoky\Modules\Controllers\ControllerInterfaces;

/**
 * Interface ModulesInterfaces
 * @package Smoky\Modules\Module
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
     * Allow to load every Controller into the Module.
     *
     * [INFO]
     *
     * This method allow to load every Controller into the Module->controller[] array, this way, the Module can keep
     * the control over every Controller passed inside him, once the Controller is store, the Module can access into
     * this one by searching the Controller by is name or by finding all the Controller stored.
     *
     * [WARNING]
     *
     * This method is call by the Module AND only by the Module.
     */
    public function loadControllers();

    /**
     * Allow to register the Controllers into the Module.
     *
     * [INFO]
     *
     * This method is call by the Module inside the --Module folder, the user must save every Controller into the method
     * if he want to store the Controller.
     *
     * [WARNING]
     *
     * This method isn't call directly by the Module class, she's call by the ---Module class inside every ---Module
     * folder.
     *
     * @return ControllerInterfaces[]    The array who contain all the Controller.
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
     * @return ControllerInterfaces[]
     */
    public function getControllers();

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