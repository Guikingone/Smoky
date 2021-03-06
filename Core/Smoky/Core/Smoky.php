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

use Smoky\Modules\Module\ModulesInterfaces;
use Smoky\Modules\ModulesManager\ModulesManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\RouteCollection;

/**
 * The Smoky framework class.
 *
 * @package Smoky\Core
 */
abstract class Smoky extends ContainerBuilder implements
               SmokyInterface
{
    /** The version of the framework. */
    const VERSION = '1.0';

    /** @var string The environment used. */
    protected $environment;

    /** @var boolean If debug mode is allowed. */
    protected $debug = false;

    /** @var boolean The status of the framework. */
    protected $booted = false;

    /** @var float The current time since the boot of the framework (using UNIX timestamp). */
    private $bootTime;

    /** The container of dependencyInjection, used to register and find dependencies. */
    protected $container;

    /** @var ModulesInterfaces[] The array who contains all the Modules loaded into the framework. */
    protected $modules;

    /** @var ModulesManager The ModulesManager used to load and launch the Modules phase and dependencies. */
    protected $modulesManager;

    /**
     * Smoky constructor.
     *
     * @param string               $environment The environment used.
     * @param boolean              $debug       Allow to debug or not.
     * @param RouteCollection|null $route
     */
    public function __construct($environment, $debug, RouteCollection $route = null)
    {
        $this->setEnvironment($environment);
        $this->setDebug($debug);
        $this->boot();

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

    /**
     * =================================================================================================================
     *  CORE METHODS
     *
     *  This methods gave access to the core of Smoky, be sure to have full knowledge about what the methods does into
     *  the framework process.
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function boot()
    {
        if ($this->bootStatus()) {
            return;
        }

        $this->booted = true;

        $this->initializeCore();

        // Load every Modules into Smoky.
        $this->loadModules();
    }

    /** @inheritdoc */
    public function shutdown()
    {
        if ($this->booted = false || $this->environment = 'prod') {
            return;
        }

        $this->booted = false;
    }

    /** @inheritdoc */
    public function loadModules()
    {
        $this->modules = array();

        foreach ($this->registerModules() as $module) {
            $name = $module->getName();
            $this->modules[$name] = $module;
        }
    }

    /** @inheritdoc */
    public function initializeCore()
    {
        // TODO
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
        try {
            $this->get('kernel')->terminate($request, $response);
        } catch (\Exception $e) {
            $e->getMessage();
        }
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

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function setEnvironment($environment)
    {
        $this->environment = (string) $environment;
    }

    /** @inheritdoc */
    public function setDebug($debug)
    {
        if ($debug) {
            $this->setBootTime(microtime(true));
        }

        $this->debug = (boolean) $debug;
    }

    /** @inheritdoc */
    public function setBootTime($bootTime)
    {
        $this->bootTime = (float) $bootTime;
    }

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /** @inheritdoc */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /** @inheritdoc */
    public function debugStatus()
    {
        return $this->debug;
    }

    /** @inheritdoc */
    public function bootStatus()
    {
        return $this->booted;
    }

    /** @inheritdoc */
    public function getBootTime()
    {
        return $this->bootTime;
    }

    /** @inheritdoc */
    public function getModules()
    {
        return $this->modules;
    }
}