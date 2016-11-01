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
use Zend\Config\Config;

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

    /** @var boolean The current time since the Module have boot (using UNIX Timestamp). */
    private $bootTime;

    /** @var boolean If the Module is lazy or not. */
    protected $lazy;

    /** @var array The configuration of the Module. */
    protected $config;

    /** @var ControllerInterfaces[] The array who contain Controllers. */
    protected $controllers;

    /** @var array|object The array who contains all the services stored into the Module. */
    protected $services;

    /** @var array|object The array who contains all the entities stored into the Module. */
    protected $entities;

    /** @var array|object The array who contains all the repositories stored into the Module. */
    protected $repositories;

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

        $this->bootTime = microtime(true);

        $this->setName($this->getName());

        // Load the configuration of the Module.
        $this->loadConfig();

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
    public function loadConfig()
    {
        $config = $this->getConfig();

        $loader = new Config($config);

        $this->config = $loader;

        // Dispatch the configurations keys.
        $this->dispatchConfig($loader);
    }

    /** @inheritdoc */
    public function dispatchConfig($configKey)
    {
        // Load the 'basics' information of the Modules.
        $this->lazy = $configKey->Lazy;

        // Load every Controller, Services, etc ...
        foreach ($configKey->Controllers as $ctlName => $controller) {
            $class = new $controller();
            $this->controllers[$ctlName] = $class;
        }

        foreach ($configKey->Services as $srvName => $service) {
            $class = new $service();
            $this->services[$srvName] = $class;
        }

        foreach ($configKey->Entity as $entName => $entity) {
            $class = new $entity();
            $this->entities[$entName] = $class;
        }

        foreach ($configKey->Repository as $rpName => $repository) {
            $class = new $repository();
            $this->repositories[$rpName] = $class;
        }
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