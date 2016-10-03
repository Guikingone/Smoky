<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core\Smoky\DependencyContainer;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DependencyContainer
 * @package Core\Smoky\DependencyContainer
 */
class DependencyContainer extends ContainerBuilder
{
    /**
     * @inheritdoc
     */
    public function register($id, $class = null)
    {
        return parent::register($id, $class);
    }
}