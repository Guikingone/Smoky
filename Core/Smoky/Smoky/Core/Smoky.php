<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Smoky;

use Symfony\Component\HttpKernel\HttpKernel;

/**
 * The Smoky framework class.
 *
 * @package Smoky\Smoky\Model
 */
class Smoky extends HttpKernel implements
      SmokyInterface
{

    protected $modules;

    /**
     * Save every modules passed to the method into the modules array.
     */
    public function registerModules()
    {
        $this->modules = array();

        foreach ($this->modules as $module) {
            $name = $module->getName();
            $this->modules[$name] = $module;
        }
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->modules;
    }
}