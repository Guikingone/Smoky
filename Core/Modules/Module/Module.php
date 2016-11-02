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

    /** @var array The array who contains all the services stored into the Module. */
    protected $services;

    /** @var array The array who contains all the entities stored into the Module. */
    protected $entities;

    /** @var array The array who contains all the repositories stored into the Module. */
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

        $this->setName();

        // Give a boot status and a boot time.
        $this->setBootStatus(true);

        // Load the configuration of the Module.
        $this->loadConfig();
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
        try {
            $this->dispatchConfig($loader);
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** @inheritdoc */
    public function dispatchConfig($configKey)
    {
        // Load the 'basics' information of the Modules.
        $this->lazy = $configKey->Lazy;

        // Load every Controller, Services, etc ...
        try {
            if (isset($configKey->Controllers)) {
                foreach ($configKey->Controllers as $ctlName => $controller) {
                    $class = new $controller();
                    if (array_key_exists($class->getName(), $this->config)) {
                        throw new \LogicException(
                            sprintf(
                                'Impossible to register two Controllers with the same name, 
                            already find : "%s"', $class->getName()
                            )
                        );
                    } elseif ($class->getBootStatus() !== true) {
                        throw new \LogicException(
                            sprintf(
                                'The Controller must be started before the injection into the Module, 
                            actual state : "%s"', $class->getBootStatus()
                            )
                        );
                    }
                    $this->controllers[$ctlName] = $class;
                }
            }

            if (isset($configKey->Services)) {
                foreach ($configKey->Services as $srvName => $service) {
                    $class = new $service();
                    if (array_key_exists(get_class($class), $this->config)) {
                        throw new \LogicException(
                            sprintf(
                                'Impossible to register two Services with the same name, 
                            already find : "%s"', get_class($class)
                            )
                        );
                    }
                    $this->services[$srvName] = $class;
                }
            }

            if (isset($configKey->Entity)) {
                foreach ($configKey->Entity as $entName => $entity) {
                    $class = new $entity();
                    if (array_key_exists(get_class($class), $this->config)) {
                        throw new \LogicException(
                            sprintf(
                                'Impossible to register two Entity with the same name, 
                            already find : "%s"', get_class($class)
                            )
                        );
                    }
                    $this->entities[$entName] = $class;
                }
            }

            if (isset($configKey->Repository)) {
                foreach ($configKey->Repository as $rpName => $repository) {
                    $class = new $repository();
                    if (array_key_exists(get_class($class), $this->config)) {
                        throw new \LogicException(
                            sprintf(
                                'Impossible to register two Repository with the same name, 
                            already find : "%s"', get_class($class)
                            )
                        );
                    }
                    $this->repositories[$rpName] = $class;
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
    public function getName()
    {
        $name = get_class($this);
        $pos = strrpos($name, '\\');

        return $this->name = false === $pos ? $name : substr($name, $pos + 1);
    }

    /** @inheritdoc */
    public function isLazy()
    {
        return $this->lazy;
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

    /** @inheritdoc */
    public function getServices()
    {
        return $this->services;
    }

    /** @inheritdoc */
    public function getEntities()
    {
        return $this->entities;
    }

    /** @inheritdoc */
    public function getRepositories()
    {
        return $this->repositories;
    }

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function setName()
    {
        $this->name = (string) $this->getName();
    }

    /** @inheritdoc */
    public function setBootStatus($booted)
    {
        $this->booted = (boolean) $booted;
        $this->setBootTime();
    }

    /** @inheritdoc */
    public function setBootTime()
    {
        $this->bootTime = microtime(true);
    }
}