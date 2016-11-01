<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\ModulesManager;

use Smoky\Modules\Module\ModulesInterfaces;
use Smoky\Modules\Events\ModulesEventsInterfaces;
use Smoky\Modules\Listener\ModulesListenerInterfaces;

/**
 * Interface ModulesManagerInterface
 * @package Smoky\Modules\ModulesManager
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
     * Allow to stop the ModulesManager and stop the Modules stored.
     *
     * [WARNING]
     *
     * This method should be called only and ONLY if the ModulesManager create a problem with a existent dependency.
     */
    public function stop();

    /**
     * Add the different keys that allow to stored the Modules, this keys will be used in order to launch Event
     * during the execution process, every Event will be stored with the "adequate" key and the dispatcher will grab
     * the key to launch every Events.
     *
     * This keys are also used by the Listeners in order to find Events, once the Events is find, the Listener is
     * instantiate and "linked" to this key, the Dispatcher will grab the key and launch the Listener by this last one.
     *
     * Every components used the same keys and can be instantiate during the whole process of finding the keys, in order
     * to be effective, the keys are stored and never changed.
     */
    public function loadKeys();

    /**
     * Allow to register new Modules into the ModulesManager.
     *
     * [INFO]
     *
     * This method is called automatically by the boot() method, in order to be effective, every Module is store inside
     * the ModulesManager->modules[] array.
     *
     * @return ModulesInterfaces[]    The array who contains all the Modules stored into the ModulesManager.
     */
    public function registerModules();

    /**
     * Allow to load the Modules into the Modules array.
     *
     * @throws \LogicException    Only when two modules with the same name are find.
     */
    public function loadModules();

    /**
     * Attach a Event for each Modules stored in the Modules array.
     *
     * @throws \LogicException    Only if two Events with the same name are find.
     */
    public function addEvents();

    /**
     * Attach a Listener for each Events stored in the Events array.
     *
     * @throws \LogicException    Only when two listeners with the same name are find.
     */
    public function addListeners();

    /**
     * Allow to clean all the Events stored into the ModulesManager.
     */
    public function clearEvents();

    /**
     * Allow to clean all the Listeners stored into the ModulesManager.
     */
    public function clearListeners();

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
     * @return array
     */
    public function getKeys();

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