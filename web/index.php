<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../app/autoload.php';
require_once __DIR__ . '/../Core/Smoky/autoload.php';
require_once __DIR__ . '/../Core/DependencyContainer/autoload.php';
require_once __DIR__ . '/../Core/Modules/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$dependencyContainer = include __DIR__ . '/../app/Dependency/DependencyContainer.php';
$dependencyContainer->setParameter('routes', include __DIR__ . '/../app/routes/routes.php');

$request = Request::createFromGlobals();

$response = $dependencyContainer->get('smoky')->handle($request);
$response->send();
