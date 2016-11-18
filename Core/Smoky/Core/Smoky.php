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
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\RouteCollection;
use Zend\Config\Config;

/**
 * The Smoky framework class.
 */
abstract class Smoky extends ContainerBuilder implements SmokyInterface
{
    /** The version of the framework. */
    const VERSION = '1.0';

    /** @var string The environment used. */
    private $environment;

    /** @var bool If debug mode is allowed. */
    private $debug = false;

    /** @var string The locale language used. */
    private $locale;

    /** @var bool The status of the framework. */
    private $booted = false;

    /** @var float The current time since the boot of the framework (using UNIX timestamp). */
    private $bootTime;

    /** @var array The configuration of Smoky, used in order to store keys. */
    protected $config;

    /** @var array The providers stored into the framework, every one is accessible. */
    private $providers;

    /** @var ModulesInterfaces[] The array who contains all the Modules loaded into the framework. */
    protected $modules;

    /** @var ContainerBuilder Contains the ContainerBuilder build during the boot process of the framework. */
    protected $container;

    /**
     * Smoky constructor.
     *
     * @param string               $environment The environment used
     * @param bool                 $debug       Allow to debug or not
     * @param RouteCollection|null $route
     */
    public function __construct($environment, $debug, RouteCollection $route = null)
    {
        $this->setEnvironment($environment);
        $this->setDebug($debug);
        $this->boot();

        $this->register('ModulesManager', 'Smoky\Provider\ModulesManagerProvider');

        // Load the providers
        $this->register('Http', 'Smoky\Provider\HttpKernelProvider');
        $this->register('Modules', 'Smoky\Provider\ModulesManagerProvider');

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
                new Reference('argument_resolver'),
            ));

        parent::__construct();
    }

    /**
     * =================================================================================================================
     *  CORE METHODS.
     *
     *  This methods gave access to the core of Smoky, be sure to have full knowledge about what the methods does into
     *  the framework process.
     * =================================================================================================================
     */

    /** {@inheritdoc} */
    public function boot()
    {
        if ($this->bootStatus()) {
            return;
        }

        $this->booted = true;

        // Load the configuration.
        $this->loadConfig();
    }

    /** {@inheritdoc} */
    public function shutdown()
    {
        if ($this->bootStatus() === false || $this->getEnvironment() === 'prod') {
            return;
        }

        $this->booted = false;
    }

    /** {@inheritdoc} */
    public function loadConfig()
    {
        $config = $this->getLocalConfig();

        $loader = new Config($config);

        $this->config = $loader;

        // Dispatch the config through the framework.
        $this->dispatchConfig($loader);

        // Initialize the core of Smoky.
        $this->initializeCore();
    }

    /** {@inheritdoc} */
    public function dispatchConfig($configKey)
    {
        if (isset($configKey->Locale)) {
            $this->locale = $configKey->Locale;
        }

        try {
            $this->modules = [];

            if (isset($configKey->Modules)) {
                foreach ($configKey->Modules as $module => $value) {
                    $class = new $value();
                    if (!$class instanceof ModulesInterfaces) {
                        throw new \LogicException(
                            sprintf(
                                'Impossible to register module who\'s not a 
                                ModulesInterfaces instance, given : "%s"', gettype($class)
                            )
                        );
                    }
                    $this->modules[$class->getName()] = $class;
                }
            }
        } catch (\LogicException $e) {
            $e->getMessage();
        }

        if (isset($configKey->Core)) {
            foreach ($configKey->Core as $class => $cl) {
                $this->register($class, $cl);
            }
        }
    }

    /** {@inheritdoc} */
    public function getCoreParameters()
    {
        $modules = [];

        foreach ($this->modules as $module => $value) {
            $modules[$module] = get_class($value);
        }

        return [
            'core.version' => static::VERSION,
            'core.environment' => $this->getEnvironment(),
            'core.debug' => $this->debugStatus(),
            'core.locale' => $this->locale,
            'core.booted' => $this->bootStatus(),
            'core.modules' => $modules
        ];
    }

    /** {@inheritdoc} */
    public function initializeCore()
    {
        if ($this->getCoreParameters()) {
            $container = new ContainerBuilder(new ParameterBag($this->getCoreParameters()));
        }

        foreach ($this->modules as $module) {
            $container->register($module->getName(), $module);

            if ($module instanceof ModulesManager) {
                $class = new \ReflectionObject($module);
                $container->register("$class", $class);
            }
        }

        $this->container = $container;
    }

    /** {@inheritdoc} */
    public function loadProviders()
    {
        $this->providers = [];

        try {

        } catch (\LogicException $e) {
            $e->getMessage();
        }
    }

    /** {@inheritdoc} */
    public function handle(Request $request, $type = HttpKernel::MASTER_REQUEST, $catch = true)
    {
        if (!$this->bootStatus()) {
            $this->boot();
        }

        return $this->get('kernel')->handle($request, $type, $catch);
    }

    /** {@inheritdoc} */
    public function terminate(Request $request, Response $response)
    {
        try {
            $this->get('kernel')->terminate($request, $response);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /** {@inheritdoc} */
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
     * ==========================================================================
     *  SETTERS
     * ==========================================================================.
     */

    /** {@inheritdoc} */
    public function setEnvironment($environment)
    {
        $this->environment = (string) $environment;
    }

    /** {@inheritdoc} */
    public function setDebug($debug)
    {
        if ($debug) {
            $this->setBootTime(microtime(true));
        }

        $this->debug = (bool) $debug;
    }

    /** {@inheritdoc} */
    public function setBootTime($bootTime)
    {
        $this->bootTime = (float) $bootTime;
    }

    /**
     * ==========================================================================
     *  GETTERS
     * ==========================================================================.
     */

    /** {@inheritdoc} */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /** {@inheritdoc} */
    public function debugStatus()
    {
        return $this->debug;
    }

    /** {@inheritdoc} */
    public function bootStatus()
    {
        return $this->booted;
    }

    /** {@inheritdoc} */
    public function getBootTime()
    {
        return $this->bootTime;
    }

    /** {@inheritdoc} */
    public function getModules()
    {
        return $this->modules;
    }
}
