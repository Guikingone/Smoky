<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Provider;

use Smoky\Core\Providers\Provider;
use Smoky\Modules\ModulesManager\ModulesManager;

class ModulesManagerProvider extends Provider
{
    /** {@inheritdoc} */
    public function loadClasses()
    {
        return [
          'ModulesManager' => ModulesManager::class,
        ];
    }
}
