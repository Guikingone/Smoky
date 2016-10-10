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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;

/**
 * Interface SmokyInterface
 * @package Smoky\Core
 */
interface SmokyInterface
{
    /**
     * Allow to boot the framework.
     */
    public function boot();

    /**
     * Allow to store all the modules into the $modules array.
     */
    public function registerModules();

    /**
     * Allow to get all the Modules stored into the DependencyContainer.
     *
     * @return mixed
     */
    public function getModules();

    /**
     * Handle the $request Request and return a $response Response, the $type is passed automatically,
     * the $catch parameters allow to handle all the Exceptions launched.
     *
     * @param Request   $request  A simple Request instance.
     * @param integer   $type     The type of request (by default, HttpKernel::MASTER_REQUEST
     * @param bool      $catch    Catch the Exception that occurs or not.
     *
     * @throws \Exception       Only if a \Exception occur during execution.
     *
     * @return Response         A simple Response.
     */
    public function handle(Request $request, $type = HttpKernel::MASTER_REQUEST, $catch = true);

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
}