<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Test\ModulesTest;

use Smoky\Modules\Module\Module;

class UserModule extends Module
{
    /** @inheritdoc */
    public function registerControllers()
    {
        return [
            new IndexController()
        ];
    }
}