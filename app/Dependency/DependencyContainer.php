<?php

use Symfony\Component\DependencyInjection\Reference;

$smokyContainer = new \Smoky\DependencyContainer\DependencyContainer();

$smokyContainer->register('context', 'Symfony\Component\Routing\RequestContext');
$smokyContainer->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
               ->setArguments(array('%routes%', new Reference('context')))
;
$smokyContainer->register('request_stack', 'Symfony\Component\HttpFoundation\RequestStack');
$smokyContainer->register('controller_resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');
$smokyContainer->register('argument_resolver', 'Symfony\Component\HttpKernel\Controller\ArgumentResolver');

$smokyContainer->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher'), new Reference('request_stack')))
;
$smokyContainer->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('UTF-8'))
;
$smokyContainer->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Core\Smoky\Components\Controller\ExceptionController::errorAction'))
;
$smokyContainer->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
;
$smokyContainer->register('smoky', 'Core\Smoky\Smoky\Core\Smoky')
    ->setArguments(array(
        new Reference('dispatcher'),
        new Reference('controller_resolver'),
        new Reference('request_stack'),
        new Reference('argument_resolver'),
    ))
;

return $smokyContainer;