<?php

namespace AppModule;

use AppModule\Controller\IndexController;
use Smoky\Modules\Module\Module;

class AppModule extends Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function registerControllers()
    {
        return [
            new IndexController()
        ];
    }
}