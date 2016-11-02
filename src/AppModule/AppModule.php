<?php

namespace AppModule;

use Smoky\Modules\Module\Module;

class AppModule extends Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}