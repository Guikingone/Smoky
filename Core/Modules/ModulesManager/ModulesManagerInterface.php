<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\ModulesManager;

use Smoky\Modules\Events\ModulesEvents;
use Smoky\Modules\Events\ModulesEventsInterfaces;
use Smoky\Modules\Listener\ModulesListenerInterfaces;
use Smoky\Modules\ModulesInterfaces;

/**
 * Interface ModulesManagerInterface
 * @package Smoky\ModulesManager
 */
interface ModulesManagerInterface
{
    /**
     * =================================================================================================================
     *  CORE METHODS
     * =================================================================================================================
     */

    /**
     * Allow to boot the Component.
     */
    public function boot();

    /**
     * Allow to register new Modules into the ModulesManager.
     *
     * @return ModulesInterfaces[] The array of Modules stored into the ModulesManager.
     */
    public function registerModules();

    /**
     * Allow to load the Modules into the Modules array.
     *
     * @throws \LogicException  Only when two modules with the same name are find.
     */
    public function loadModules();

    /**
     * Attach a Event for each Modules stored in the Modules array.
     */
    public function addEvents();

    /**
     * Attach a Listener for each Events stored in the Events array.
     */
    public function addListener();

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /**
     * @return boolean
     */
    public function getBootStatus();

    /**
     * @return boolean
     */
    public function getLoadStatus();

    /**
     * @return ModulesInterfaces[]
     */
    public function getModules();

    /**
     * @return ModulesEventsInterfaces[]
     */
    public function getEvents();

    /**
     * @return ModulesListenerInterfaces[]
     */
    public function getListeners();

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param $bootStatus boolean
     */
    public function setBootStatus($bootStatus);

    /**
     * @param $loadStatus boolean
     */
    public function setLoadStatus($loadStatus);
}