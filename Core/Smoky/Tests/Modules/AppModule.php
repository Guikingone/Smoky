<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Test\Modules;

/**
 * Class AppModule
 * @package Smoky\Test\Modules
 */
class AppModule
{
    /** @inheritdoc */
    public function getName()
    {
        $name = get_class($this);

        return $this->name = $name;
    }
}