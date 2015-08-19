<?php

namespace YawikDemoSkin;

use Zend\Mvc\MvcEvent;

/**
 * Bootstrap class of our demo skin
 */
class Module
{
    /**
     * indicates, that the autoload configuration for this module should be loaded.
     * @see
     *
     * @var bool
     */
    public static $isLoaded=false;


    function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    function onBootstrap()
    {
        self::$isLoaded=true;
    }
}
