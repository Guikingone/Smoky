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
     * Allow to stop the ModulesEvents.
     */
    public function stop();

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
     * @return null|string|object
     */
    public function getTarget();

    /**
     * @return array
     */
    public function getParams();

    /**
     * Allow to get a single parameters.
     *
     * @param string $name      The name of the parameters.
     *
     * @return mixed
     */
    public function getParam($name);

    /**
     * @return bool
     */
    public function isPropagationStopped();

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
     *
     * @return void
     */
    public function setName($name);

    /**
     * @param null|string|object $target
     *
     * @return void
     */
    public function setTarget($target);

    /**
     * @param array $params
     *
     * @return void
     */
    public function setParams($params);

    /**
     * @param bool $flag
     */
    public function stopPropagation($flag);
}