<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Smoky\Modules\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ControllerInterfaces
{
    /**
     * Allow to boot the Controller.
     *
     * [INFO]
     *
     * This method is call automatically by the __constructor and start the Controller, every Controller is stored
     * inside the ModulesManager->controller[] only if he's started, in the other case, the Controller is boot and
     * stored if the call come from a valid Request.
     */
    public function boot();

    /**
     * Allow to stop the Controller.
     *
     * [WARNING]
     *
     * This method should be called only if the Controller cause problem with an other Controller or if the execution
     * of this last one can lead to injection problem.
     */
    public function stop();

    /**
     * Allow to call a View linked to this method.
     *
     * [INFO]
     *
     * This method should be called only of the array passed through the view isn't full and can be replace with the
     * @View annotation.
     * Keep in mind that a Controller should ONLY link a Request to a Response and not perform logic, this way,
     * this method should be the only one called into the array passed to the Controller.
     *
     * @param string $view    The view needed.
     */
    public function callView($view);

    /**
     * Allow to call a Model in order to make BDD request.
     *
     * [INFO]
     *
     * This method can be called in order to perform BDD request within the Controller, in order to respect the MVC
     * pattern, BDD request with the Model or with the Repository should be performs inside a Service and passed through
     * the Controller after InjectionContainer call, this way, the Controller stay clean and simple and keep is only
     * purpose of linking a Request to a Response.
     *
     * @param string $model    The model needed.
     *
     */
    public function callModel($model);

    /**
     * Allow to call a Repository in order to receive data from a Entity|Model.
     *
     * [INFO]
     *
     * This method can be called inside a Controller in order to fetch|receive data from a Entity|Model, the principal
     * goal is to use the "existing" request in order to keep the flow of the Controller and keep this last one clean.
     * If you prefer to keep the Controller out of the logic of receiving data from the Entity, please, use the built-in
     * method "getRepository" inside a Service to call a Repository and perform more advanced request this repository.
     *
     * @param string $repository    The repository needed.
     *
     */
    public function callRepository($repository);

    /**
     * Allow to return a JsonResponse.
     *
     * [INFO]
     *
     * This method allow to call a JsonResponse from HttpFoundation component of Symfony, be sure to use a serializer to
     * complete the process, this method can't do the work of serialize the data.
     *
     * @param array $data    The data who's gonna been send to the Response.
     *
     * @return JsonResponse    The response send to the client.
     */
    public function callJsonResponse($data);

    /**
     * @return string    The name of the Controller.
     */
    public function getName();

    /**
     * @return boolean    The status of the boot phase of the Controller.
     */
    public function getBootStatus();

    /**
     * @param $booted
     */
    public function setBootStatus($booted);
}