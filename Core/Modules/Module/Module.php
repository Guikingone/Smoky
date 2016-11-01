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
 * Class Module
 * @package Smoky\Modules\Module
 */
abstract class Module implements
               ModulesInterfaces
{
    /** @var string The name of the Module. */
    protected $name;

    /** @var boolean The status of the Module. */
    protected $booted;

    /** @var ControllerInterfaces[] The array who contain Controllers. */
    protected $controllers;

    /** @var array|object The array who contains all the services stored into the Module. */
    protected $services;

    /**
     * Module constructor.
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
        if (false === $this->getModuleStatus()) {
            return;
        }

        $this->setBootStatus(true);

        $this->setName($this->getName());

        // Load every Controllers into the Module.
        $this->loadControllers();
    }

    /** @inheritdoc */
    public function stop()
    {
        if (!$this->getModuleStatus()) {
            return;
        }

        $this->setBootStatus(false);
    }

    /** @inheritdoc */
    public function loadControllers()
    {
        $this->controllers = array();

        try {
            foreach ($this->registerControllers() as $controller) {
                $name = $controller->getName();
                if (!is_object($controller)) {
                    throw new \LogicException(
                        sprintf(
                            'Impossible to register a Controller who\'s not a object, 
                        given : "%s"', gettype($controller)
                        )
                    );
                } elseif (array_key_exists($name, $this->controllers)) {
                    throw new \LogicException(
                        sprintf(
                            'Impossible to register two Controllers with the same name, 
                            already find : "%s"', $name
                        )
                    );
                } elseif ($controller->getBootStatus() !== true) {
                    throw new \LogicException(
                        sprintf(
                            'The Controller must be started before the injection into the Module, 
                            actual state : "%s"', $controller->getBootStatus()
                        )
                    );
                }
                $this->controllers[$name] = $controller;
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
    public function getName()
    {
        $name = get_class($this);
        $pos = strrpos($name, '\\');

        return $this->name = false === $pos ? $name : substr($name, $pos + 1);
    }

    /** @inheritdoc */
    public function getModuleStatus()
    {
        return $this->booted;
    }

    /** @inheritdoc */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /** @inheritdoc */
    public function setBootStatus($booted)
    {
        $this->booted = (boolean) $booted;
    }
}