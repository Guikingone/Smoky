<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules;

/**
 * Class Module
 * @package Smoky\Modules
 */
class Module implements
      ModulesInterfaces
{
    /** @var string The name of the Module. */
    protected $name;

    /** @var boolean The status of the Module. */
    protected $booted;

    /**
     * Module constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /** @inheritdoc */
    public function boot()
    {
        if (false === $this->moduleStatus()) {
            return;
        }

        $this->booted = true;
    }

    /** @inheritdoc */
    public function stop()
    {
        $this->booted = false;
        return $this;
    }

    /** @inheritdoc */
    public function getName()
    {
        $name = get_class($this);

        return $this->name = $name;
    }

    /** @inheritdoc */
    public function moduleStatus()
    {
        return $this->booted;
    }
}