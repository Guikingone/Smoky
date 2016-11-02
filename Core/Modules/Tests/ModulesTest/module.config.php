<?php

/*
 * This file is part of the Smoky project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'Lazy' => false,
    'Controllers' => [
        'Index' => \Smoky\Modules\Test\ModulesTest\IndexController::class
    ],
    'Entity' => [
        'Article' => \Smoky\Modules\Test\ModulesTest\Article::class
    ],
    'Repository' => [
        'ArticleRepository' => \Smoky\Modules\Test\ModulesTest\ArticleRepository::class
    ]
];