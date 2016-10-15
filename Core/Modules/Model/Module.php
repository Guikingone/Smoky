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
 * Class Module
 * @package Smoky\Modules\Model
 */
abstract class Module implements
      ModulesInterfaces
{
    /** @var string The name of the Module. */
    protected $name;

    /** @var boolean The status of the Module. */
    protected $booted;

    /** @var ControllerInterfaces[] The array who contains all the Controllers stored into the Module. */
    protected $controllers = [];

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
    }

    /** @inheritdoc */
    public function stop()
    {
        $this->booted = false;
        return $this;
    }

    /** @inheritdoc */
    public function loadControllers()
    {
        try {
            $this->controllers = array();

            foreach ($this->getControllers() as $controller) {

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
    public function setBootStatus($booted)
    {
        $this->booted = (boolean) $booted;
    }
}