<?php

namespace YawikDemoSkin;

use Core\ModuleManager\Feature\VersionProviderInterface;
use Core\ModuleManager\Feature\VersionProviderTrait;
use Core\ModuleManager\ModuleConfigLoader;
use Zend\Console\Console;
use Zend\Mvc\MvcEvent;

/**
 * Bootstrap class of our demo skin
 */
class Module implements VersionProviderInterface
{
    use VersionProviderTrait;

    const VERSION = '1.1.0';

    /**
     * indicates, that the autoload configuration for this module should be loaded.
     * @see
     *
     * @var bool
     */
    public static $isLoaded=false;

    /**
     * Using the ModuleConfigLoader allow you to split the modules.config.php into several files.
     *
     * @return array
     */
    public function getConfig()
    {
        return ModuleConfigLoader::load(__DIR__ . '/../config');
    }

    function onBootstrap(MvcEvent $e)
    {
        self::$isLoaded=true;
        $eventManager = $e->getApplication()->getEventManager();
        $services     = $e->getApplication()->getServiceManager();


        /*
         * remove Submenu from "applications"
         */
        $config=$services->get('config');
        unset($config['navigation']['default']['apply']['pages']);
        $services->setAllowOverride(true);
        $services->setService('config', $config);
        $services->setAllowOverride(false);

        if (!Console::isConsole()) {
            $sharedManager = $eventManager->getSharedManager();

            /*
             * use a neutral layout, when rendering the application form and its result page.
             * Also the application preview should be rendered in this layout.
             *
             * We need a post dispatch hook on the controller here as we need to have
             * the application entity to determine how to set the layout in the preview page.
             */
            $callback=function ($event) {
                    $viewModel  = $event->getViewModel();
                    $template   = 'layout/application-form';
                    $controller = $event->getTarget();

                    if ($controller instanceof \Applications\Controller\ApplyController) {
                        $viewModel->setTemplate($template);
                        return;
                    }

                    if ($controller instanceof \Applications\Controller\ManageController
                        && 'detail' == $event->getRouteMatch()->getParam('action')
                        && 200 == $event->getResponse()->getStatusCode()
                    ) {
                        $result = $event->getResult();
                        if (!is_array($result)) {
                            $result = $result->getVariables();
                        }
                        if ($result['application']->isDraft()) {
                            $viewModel->setTemplate($template);
                        }
                    }

                };

            foreach (array('Applications','CamMediaintown') as $identifier) {
                $sharedManager->attach($identifier, MvcEvent::EVENT_DISPATCH, $callback, -2 /*postDispatch, but before most of the other zf2 listener*/ );
            }

        }

    }
}
