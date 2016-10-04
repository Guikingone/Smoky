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
 * Interface ModulesInterfaces
 * @package Smoky\Modules\Model
 */
interface ModulesInterfaces
{
    /**
     * @return boolean
     */
    public function boot();

    /**
     * @return boolean
     */
    public function stop();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function moduleStatus();
}