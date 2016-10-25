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

/**
 * Interface SmokyInterface
 * @package Smoky\Core
 */
interface SmokyInterface extends HttpKernelInterface, TerminableInterface
{
    /**
     * =================================================================================================================
     *  CORE METHODS
     * =================================================================================================================
     */

    /**
     * Allow to boot the framework and inject the Modules with the instance.
     */
    public function boot();

    /**
     * Shutdown the framework and clear the modules saved.
     *
     * [WARNING]
     *
     * The method must be called only if a Request is not find or not launch || if the application
     * isn't running in 'prod' mode.
     */
    public function shutdown();

    /**
     * Return a array of Modules to inject into the framework.
     *
     * @return ModulesInterfaces[] A array of Modules instances
     */
    public function registerModules();

    /**
     *
     */
    public function loadModules();

    /**
     * Initialize the core classes.
     *
     * [INFO]
     *
     * This method is called automatically by the boot phase of Smoky, this way, the Container and the ModulesManager
     * are loaded when the Request is grabbed. In order to be effective, this method is called only once, if the "cache"
     * isn't fresh, the classes are already loaded and the Core don't reload all the classes.
     */
    public function initializeCore();

    /**
     * Handle the request and return the response, once the response launched, the method terminate the process.
     *
     * @param Request|null $request
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function launch(Request $request = null);

    /**
     * =================================================================================================================
     *  INHERIT METHODS
     * =================================================================================================================
     */

    /**
     * @inheritdoc
     */
    public function handle(Request $request, $type = HttpKernel::MASTER_REQUEST, $catch = true);

    /**
     * @inheritdoc
     */
    public function terminate(Request $request, Response $response);

    /**
     * =================================================================================================================
     *  GETTERS
     * =================================================================================================================
     */

    /**
     * @return string The environment used by the framework.
     */
    public function getEnvironment();

    /**
     * @return boolean The status of debug mode.
     */
    public function debugStatus();

    /**
     * Return the status of the framework.
     *
     * @return boolean
     */
    public function bootStatus();

    /**
     * @return float The current time since the instantiation of the framework (UNIX timestamp).
     */
    public function getBootTime();

    /**
     * =================================================================================================================
     *  SETTERS
     * =================================================================================================================
     */

    /**
     * @param string $environment
     */
    public function setEnvironment($environment);


    /**
     * @param boolean $debug
     */
    public function setDebug($debug);

    /**
     * @param float $bootTime
     */
    public function setBootTime($bootTime);
}