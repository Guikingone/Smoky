<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Test;

use Smoky\Core\Smoky;
use Smoky\Test\Modules\AppModule;

class MicroSmoky extends Smoky
{
    /** {@inheritdoc} */
    public function registerModules()
    {
        return array(
          new AppModule(),
        );
    }

    /** {@inheritdoc} */
    public function getLocalConfig()
    {
        return include __DIR__.'/config/smoky.config.php';
    }
}
