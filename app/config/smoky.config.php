<?php

return [
    'Locale' => 'Fr',
    'Core' => [
        'Context' => \Symfony\Component\Routing\RequestContext::class,
        'Matcher' => \Symfony\Component\Routing\Matcher\UrlMatcher::class,
        'Request_Stack' => \Symfony\Component\HttpFoundation\RequestStack::class,
        'Controller_resolver' => \Symfony\Component\HttpKernel\Controller\ControllerResolver::class,
        'Argument_Resolver' => \Symfony\Component\HttpKernel\Controller\ArgumentResolver::class,
        'Dispatcher' => \Symfony\Component\EventDispatcher\EventDispatcher::class,
    ],
];
