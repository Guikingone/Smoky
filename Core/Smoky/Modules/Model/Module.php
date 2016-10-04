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

/**
 * Class Module
 * @package Smoky\Modules\Model
 */
class Module implements
      ModulesInterfaces
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $booted;

    /**
     * Module constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     *  Allow to boot the Module.
     */
    public function boot()
    {
        if (false === $this->booted) {
            return;
        }

        $this->booted = true;
    }

    /**
     * Stop the module into the progression.
     *
     * @return $this
     */
    public function stop()
    {
        $this->booted = false;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $name = get_class($this);

        return $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function moduleStatus()
    {
        return $this->booted;
    }
}