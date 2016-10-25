<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Smoky\Core\Smoky;

/**
 * Class AppSmoky
 */
class AppSmoky extends Smoky
{
    /** @inheritdoc */
    public function registerModules()
    {
        return [
            new \AppModule\AppModule()
        ];
    }

    /** @inheritdoc */
    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }
}