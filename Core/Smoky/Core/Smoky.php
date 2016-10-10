<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Core;

use Smoky\DependencyContainer\DependencyContainer;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;

/**
 * The Smoky framework class.
 *
 * @package Smoky\Core
 */
class Smoky extends DependencyContainer implements
      SmokyInterface
{
    /** @var bool The status of the framework. */
    protected $booted = false;

    /** @var array The array representing the dependencies of the core. */
    protected $dependencies = array();

    /** @var array The array representing the Modules saved into the core. */
    protected $modules;

    /**
     * Smoky constructor.
     * @param RouteCollection $route
     */
    public function __construct(RouteCollection $route)
    {
        $this->register('context', 'Symfony\Component\Routing\RequestContext');
        $this->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
             ->setArguments(array($route, new Reference('context')));
        $this->register('request_stack', 'Symfony\Component\HttpFoundation\RequestStack');
        $this->register('controller_resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');
        $this->register('argument_resolver', 'Symfony\Component\HttpKernel\Controller\ArgumentResolver');
        $this->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
            ->setArguments(array(new Reference('matcher'), new Reference('request_stack')));
        $this->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
            ->setArguments(array('UTF-8'));
        $this->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
            ->setArguments(array('Core\Smoky\Components\Controller\ExceptionController::errorAction'));
        $this->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
            ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
            ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
            ->addMethodCall('addSubscriber', array(new Reference('listener.exception')));
        $this->register('kernel', 'Symfony\Component\HttpKernel\HttpKernel')
             ->setArguments(array(
                 new Reference('dispatcher'),
                 new Reference('controller_resolver'),
                 new Reference('request_stack'),
                 new Reference('argument_resolver')
             ));

        parent::__construct();
    }

    /** @inheritdoc */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;
    }


    /** @inheritdoc */
    public function registerModules()
    {
        $this->modules = array();

        foreach ($this->modules as $module) {
            $name = $module->getName();
            $this->modules[$name] = $module;
        }
    }

    /** @inheritdoc */
    public function getModules()
    {
        return $this->modules;
    }

    /** @inheritdoc */
    public function handle(Request $request, $type = HttpKernel::MASTER_REQUEST, $catch = true)
    {
        if (!$this->booted) {
            $this->boot();
        }

        return $this->get('kernel')->handle($request, $type, $catch);
    }

    /** @inheritdoc */
    public function terminate(Request $request, Response $response)
    {
        $this->get('kernel')->terminate($request, $response);
    }

    /** @inheritdoc */
    public function launch(Request $request = null)
    {
        try {
            if (null === $request) {
                $request = Request::createFromGlobals();
            }

            $response = $this->handle($request);
            $response->send();
            $this->terminate($request, $response);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}