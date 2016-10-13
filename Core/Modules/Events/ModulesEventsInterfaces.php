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

use ArrayAccess;

/**
 * Interface ModulesEventsInterfaces
 * @package Smoky\Modules\Events
 */
interface ModulesEventsInterfaces
{
    /**
     * Allow to boot the ModulesEvents.
     */
    public function boot();

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
     * @return string
     */
    public function getName();

    /**
     * @return array|object|null
     */
    public function getTarget();

    /**
     * @return array|object|ArrayAccess
     */
    public function getParams();

    /**
     * Allow to get a single parameters.
     *
     * @param string $name      The name of the parameters.
     * @param null $default     Default value if the parameters isn't find.
     *
     * @return mixed
     */
    public function getParam($name, $default = null);

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param boolean $booted
     */
    public function setBootStatus($booted);

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @param array|object|null $target
     */
    public function setTarget($target);

    /**
     * @param array|object|null $params
     */
    public function setParams($params);

    /**
     * @param string|integer $name
     * @param mixed          $value
     */
    public function setParam($name, $value);
}