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

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Smoky\Modules\Module\ModulesInterfaces;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Zend\Config\Config;

/**
 * Interface SmokyInterface.
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmokyInterface extends HttpKernelInterface, TerminableInterface
{
    /**
     * ==========================================================================
     *  CORE METHODS
     * ==========================================================================.
     */

    /**
     * Allow to boot the framework.
     *
     * [INFO]
     *
     * This method call different "sub-methods" :
     * -> loadConfig()
     * -> dispatchConfig()
     * -> initializeCore()
     *
     * [WARNING]
     *
     * This method is called automatically by the "instantiation" of the framework.
     */
    public function boot();

    /**
     * Shutdown the framework and clear the modules saved.
     *
     * [INFO]
     *
     * This method change the boot status of the framework,
     * in order to be effective, you MUST use this method assuming different case.
     *
     * [WARNING]
     *
     * The method must be called only :
     * || If a Request is not find or not launch
     * || If the application isn't running in 'prod' mode
     * || If the framework isn't "boot".
     */
    public function shutdown();

    /**
     * Load the core configuration of Smoky.
     *
     * [INFO]
     *
     * This method is call automatically by the boot() method, this way,
     * every call on the framework class load the core configuration.
     */
    public function loadConfig();

    /**
     * Allow to load the "local" configuration file and
     * hydrate the framework with this configuration.
     *
     * [INFO]
     *
     * This method should be called by the AppSmoky file and only by this one,
     * the file can be locate everywhere inside the app folder.
     */
    public function getLocalConfig();

    /**
     * Load every config keys and dispatch them into the framework.
     *
     * [INFO]
     *
     * This method is called automatically by the loadConfig() method.
     *
     * @param Config $configKey
     */
    public function dispatchConfig($configKey);

    /**
     * Returns the core parameters.
     *
     * [INFO]
     *
     * This method is used to store the different keys used by the framework,
     * this way, you can access to the whole array of keys through the entire
     * application.
     *
     * [WARNING]
     *
     * This method is called automatically by the Smoky class during the boot phase,
     * this way, every parameters stored into the array are available at any time.
     *
     * @return array The array of parameters stored into the core
     */
    public function getCoreParameters();

    /**
     * Initialize the core classes.
     *
     * [INFO]
     *
     * This method is called automatically by the boot phase of Smoky, this way,
     * the Container and the ModulesManager are loaded when the Request is grabbed.
     * In order to be effective, this method is called only once, if the "cache"
     * isn't fresh, the classes are already loaded and the Core don't reload all the classes.
     */
    public function initializeCore();

    /**
     * Load the providers into the $providers array.
     *
     * [INFO]
     *
     * This method is used in order to load every providers into the framework,
     * every providers MUST implement the Provider class and be boot.
     *
     * In order to access the providers, you MUST use the getProvider method.
     *
     * [WARNING]
     *
     * This method is called ONLY once and MUST be linked to the boot method.
     */
    public function loadProviders();

    /**
     * Handle the request and return the response, once the response launched,
     * the method terminate the process.
     *
     * @param Request|null $request
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function launch(Request $request = null);

    /**
     * ==========================================================================
     *  INHERIT METHODS
     * ==========================================================================.
     */

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, $type = HttpKernel::MASTER_REQUEST, $catch = true);

    /**
     * {@inheritdoc}
     */
    public function terminate(Request $request, Response $response);

    /**
     * ==========================================================================
     *  GETTERS
     * ==========================================================================.
     */

    /**
     * @return string The environment used by the framework
     */
    public function getEnvironment();

    /**
     * @return bool The status of debug mode
     */
    public function debugStatus();

    /**
     * @return bool The framework boot status
     */
    public function bootStatus();

    /**
     * @return float The current time since the instantiation of the framework (UNIX timestamp)
     */
    public function getBootTime();

    /**
     * @return ModulesInterfaces[] The Modules stored|used into the framework and stored into the array
     */
    public function getModules();

    /**
     * ==========================================================================
     *  SETTERS
     * ==========================================================================.
     */

    /**
     * @param string $environment
     */
    public function setEnvironment($environment);

    /**
     * @param bool $debug
     */
    public function setDebug($debug);

    /**
     * @param float $bootTime
     */
    public function setBootTime($bootTime);
}
