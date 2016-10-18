<?php

namespace AppModule;


use AppModule\Controller\IndexController;
use Smoky\Modules\Module\Module;

class AppModule extends Module
{
    public function registerControllers()
    {
        $controllers = [
            new IndexController()
        ];

        return $controllers;
    }
}