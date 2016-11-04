<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Events;

/**
 * Class ModulesEvents
 * @package Smoky\Modules\Events
 */
class ModulesEvents implements
      ModulesEventsInterfaces
{
    /** @var string The name of the Event. */
    protected $name;

    /** @var bool The status of the Event. */
    protected $booted;

    /** @var null|string|object The target of the Event. */
    protected $target;

    /** @var array The parameters passed into the Event. */
    protected $parameters;

    /** @var boolean If the propagation is stopped inside the Event. */
    private $propagationStopped = false;

    /**
     * ModulesEvents constructor.
     *
     * @param string $name                  The name of the Event.
     * @param null|string|object $target    The Event target (aka method).
     * @param array $params                 The parameters passed to this Event.
     */
    public function __construct($name, $target, $params)
    {
        $this->setName($name);
        $this->setTarget($target);
        $this->setParams($params);

        $this->boot();
    }

    /** @inheritdoc */
    public function boot()
    {
        if ($this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(true);
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
    public function getBootStatus()
    {
        return $this->booted;
    }

    /** @inheritdoc */
    public function getName()
    {
        return $this->name;
    }

    /** @inheritdoc */
    public function getTarget()
    {
        return $this->target;
    }

    /** @inheritdoc */
    public function getParams()
    {
        return $this->parameters;
    }

    /** @inheritdoc */
    public function getParam($name)
    {
        if (is_array($this->parameters) || $this->parameters instanceof \ArrayAccess) {
            if (!array_key_exists($name, $this->parameters)) {
                return null;
            }

            return $this->parameters[$name];
        }

        if (!isset($this->parameters->{$name})) {
            return null;
        }

        return $this->parameters->{$name};
    }

    /** @inheritdoc */
    public function isPropagationStopped()
    {
        return $this->propagationStopped;
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

    /** @inheritdoc */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /** @inheritdoc */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /** @inheritdoc */
    public function setParams($params)
    {
        try {
            if (!is_array($params)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Invalid type of argument, waiting for array, 
                        received "%s".', gettype($params)
                    )
                );
            }
            $this->parameters = (array) $params;
        } catch (\InvalidArgumentException $e) {
            $e->getMessage();
        }
    }

    /** @inheritdoc */
    public function stopPropagation($flag)
    {
        $this->propagationStopped = (boolean) $flag;
    }
}