<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Controller
 * @package Smoky\Modules\Controllers
 */
class Controller implements
      ControllerInterfaces
{
    /** @var string The name of the Controller. */
    protected $name;

    /** @var boolean The status of the Controller. */
    protected $booted;

    /**
     * Controller constructor.
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
        if ($this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(true);

        $this->setName($this->getName());
    }

    /** @inheritdoc */
    public function stop()
    {
        if (!$this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(false);
    }

    /** @inheritdoc */
    public function callView($view)
    {
        // TODO: Implement callView() method.
    }

    /** @inheritdoc */
    public function callModel($model)
    {
        // TODO: Implement callModel() method.
    }

    /** @inheritdoc */
    public function callRepository($repository)
    {
        // TODO: Implement callRepository() method.
    }

    /** @inheritdoc */
    public function callJsonResponse($data)
    {
        return new JsonResponse($data);
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