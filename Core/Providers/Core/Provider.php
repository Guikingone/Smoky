<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core\Providers;

/**
 * Class Provider.
 */
abstract class Provider implements ProviderInterface
{
    /** @var bool The boot status of the Provider. */
    private $booted;

    /** @var array The array who contains all the classes stored. */
    protected $classes;

    /**
     * Provider constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * ==========================================================================
     *  CORE METHODS
     * ==========================================================================.
     */

    /** {@inheritdoc} */
    public function boot()
    {
        if ($this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(true);

        try {
            foreach ($this->loadClasses() as $class => $value) {
                $this->register($class, $value);
            }
        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** {@inheritdoc} */
    public function stop()
    {
        if (!$this->getBootStatus()) {
            return;
        }

        $this->setBootStatus(false);
    }

    /** {@inheritdoc} */
    public function register($name, $class)
    {
        try {
            if (!is_string($name) || !is_object($class)) {
                throw new \LogicException(
                    sprintf(
                        'Impossible to register a new class if this last one
                        isn\'t a object or if the name isn\'t a string, 
                        given : "%s"', gettype([$name, $class]
                        )
                    )
                );
            }

            if (isset($this->classes[$name])) {
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

    /** {@inheritdoc} */
    public function get($name)
    {
        // TODO
    }

    /**
     * ==========================================================================
     *  SETTERS
     * ==========================================================================.
     */

    /** {@inheritdoc} */
    public function setBootStatus($value)
    {
        $this->booted = (bool) $value;
    }

    /**
     * ==========================================================================
     *  GETTERS
     * ==========================================================================.
     */

    /** {@inheritdoc} */
    public function getBootStatus()
    {
        return $this->booted;
    }

    /** {@inheritdoc} */
    public function getClasses()
    {
        return $this->classes;
    }
}
