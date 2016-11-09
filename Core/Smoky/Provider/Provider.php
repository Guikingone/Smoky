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

/**
 * Class Provider
 * @package Smoky\Provider
 */
abstract class Provider implements
               ProviderInterface
{
    /** @var array The array who contains all the classes stored. */
    protected $classes;

    /** @inheritdoc */
    public function register($name, $class)
    {
        try {
            if (!is_string($name) || !is_object($class)) {
                throw new \LogicException(
                    sprintf(
                        'Impossible to register a new class if this last one
                        isn\'t a object or if the name isn\'t a string, find : "%s"',
                        gettype(array($name, $class))
                    )
                );
            }

            if (array_key_exists($this->classes, $name)) {
                throw new \LogicException(
                    sprintf(
                        'Impossible to register two class with the same name, 
                        already find : "%s"', $name
                    )
                );
            }

            $this->classes[$name] = $class;
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** @inheritdoc */
    public function get($name)
    {
        // TODO
    }
}