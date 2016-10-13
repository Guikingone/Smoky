<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Listener;

class ModulesListener implements
      ModulesListenerInterfaces
{
    /** @var string The name of the Listener. */
    protected $name;

    /** @var boolean The status of the Listener. */
    protected $booted;

    /**
     * ModulesListener constructor.
     *
     * @param string $name  The name of the Listener.
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->boot();
    }

    /** @inheritdoc */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;
    }

    /** @inheritdoc */
    public function stop()
    {
        if (!$this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(false);
    }

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function getName()
    {
        return $this->name;
    }

    /** @inheritdoc */
    public function getBootStatus()
    {
        return $this->booted;
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