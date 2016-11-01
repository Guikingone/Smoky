<?php

return [
    'Lazy' => true,
    'Controllers' => [
        'IndexController' => \AppModule\Controller\IndexController::class,
        'BackController' => \AppModule\Controller\BackController::class
    ],
    'Services' => [

    ],
    'Entity' => [

    ],
    'Repository' => [

    ]

    // Add your proper config key as needed, can be used as well by the framework :
    // -> Services
    // -> Entity
    // -> Repository
];