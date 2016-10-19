<?php

use Smoky\Core\Smoky;

class AppSmoky extends Smoky
{
    public function registerModules()
    {
        $modules = [
            new \AppModule\AppModule()
        ];

        return $modules;
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }
}