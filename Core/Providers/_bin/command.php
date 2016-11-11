<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require __DIR__.'./../autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \Smoky\Core\Providers\Command\CreateProviderCommand());

$application->run();
