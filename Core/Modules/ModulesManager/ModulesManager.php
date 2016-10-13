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
use Smoky\Modules\Events\ModulesManagerEvents;
use Smoky\Modules\Listener\ModulesListener;
use Smoky\Modules\ModulesInterfaces;

/**
 * Class ModulesManager
 * @package Smoky\ModulesManager
 */
abstract class ModulesManager implements
               ModulesManagerInterface
{
    /** The version of the the Modules Manager. */
    const VERSION = '1.0';

    /** @var boolean The status of the ModulesManager. */
    protected $boot;

    /** @var ModulesEvents[] The array who contains the Events stored. */
    protected $events;

    /** @var ModulesListener[] The array who contains The Listener stored. */
    protected $listener;

    /** @var ModulesInterfaces[] The array who contain the Modules stored. */
    protected $modules = [];

    /** @var boolean The status of the loading phase of every Modules stored. */
    protected $loadStatus;

    /**
     * ModulesManager constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * =================================================================================================================
     *  CORE METHODS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function boot()
    {
        if ($this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(true);
    }

    /** @inheritdoc */
    public function loadModules()
    {
        try {
            $this->modules = array();

            foreach ($this->registerModules() as $module) {
                $name = $module->getName();
                if (array_key_exists($name, $this->modules)) {
                    throw new \LogicException(
                        sprintf('Impossible to register two modules with the same name : "%s"', $name)
                    );
                }
                $this->modules[$name] = $module;

                // Add Modules Events linked to this Modules.
                $this->addEvents();

                // Add Listener for every Events.
                //$this->addListener();
            }

            $this->setLoadStatus(true);

        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** @inheritdoc */
    public function addEvents()
    {
        try {
            $this->events = array();

            foreach ($this->modules as $module) {
                $name = $module->getName();
                $event = new ModulesEvents($name . 'Event', null, null);
                if (array_key_exists($event->getName(), $this->events)) {
                    throw new \LogicException(
                        sprintf(
                            'Impossible to register two Events with the same name, 
                            already exist : "%s"', $event->getName()
                        )
                    );
                }
                $this->events[$event->getName()][$name] = $module;
            }
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** @inheritdoc */
    public function addListener()
    {
        try {
            $this->listener = array();

            foreach ($this->modules as $module) {
                $name = $module->getName() . 'Event';
                foreach ($this->events as $event) {
                    if(array_key_exists($name, $this->events)) {
                        $listener = new ModulesListener($name . 'Listener');
                        if (array_key_exists($listener->getName(), $this->listener)) {
                            throw new \LogicException(
                                sprintf(
                                    'Impossible to register two listener with the same name,
                            already exist : "%s"', $listener->getName()
                                )
                            );
                        }
                        $this->listener[$listener->getName()] = $event;
                    }
                }
            }
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function getBootStatus()
    {
        return $this->boot;
    }

    /** @inheritdoc */
    public function getLoadStatus()
    {
        return $this->loadStatus;
    }

    /** @inheritdoc */
    public function getModules()
    {
        return $this->modules;
    }

    /** @inheritdoc */
    public function getEvents()
    {
        return $this->events;
    }

    /** @inheritdoc */
    public function getListeners()
    {
        return $this->listener;
    }

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function setBootStatus($bootStatus)
    {
        $this->boot = $bootStatus;
    }

    /** @inheritdoc */
    public function setLoadStatus($loadStatus)
    {
        $this->loadStatus = $loadStatus;
    }
}