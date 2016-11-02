<?php

return [
    'Lazy' => true,
    'Controllers' => [
        'IndexController' => \AppModule\Controller\IndexController::class
    ]

    // Add your proper config key as needed, can be used as well by the framework :
    // -> Lazy (Needed for execution !)
    // -> Controllers
    // -> Services
    // -> Entity
    // -> Repository
];