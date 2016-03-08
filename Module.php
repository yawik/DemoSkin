<?php

namespace YawikDemoSkin;

use Core\ModuleManager\ModuleConfigLoader;

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

    /**
     * Tells the autoloader, where to search for the YawikDemoSkin classes
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {

        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src',
                ),
            ),
        );
    }

    /**
     * Using the ModuleConfigLoader allow you to split the modules.config.php into several files.
     *
     * @return array
     */
    public function getConfig()
    {
        return ModuleConfigLoader::load(__DIR__ . '/config');
    }

    function onBootstrap()
    {
        self::$isLoaded=true;
    }
}
