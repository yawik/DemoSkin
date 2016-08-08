<?php

namespace YawikDemoSkin;

use Core\ModuleManager\ModuleConfigLoader;
use Zend\Console\Console;
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

    function onBootstrap(MvcEvent $e)
    {
        self::$isLoaded=true;
        $eventManager = $e->getApplication()->getEventManager();
        $services     = $e->getApplication()->getServiceManager();

        //$services->get('ViewTemplatePathStack')->setLfiProtection(False);

        $viewManager = $services->get('ViewManager');
        $viewModell1 = $viewManager->getViewModel();
        $viewModell2 = $e->getViewModel();

        /*
        $eventManager->attach(
            array(MvcEvent::EVENT_RENDER, MvcEvent::EVENT_RENDER_ERROR),
            array(new InjectLoginInfoListener(), 'injectLoginInfo'), -1000
        );

        $checkPermissionsListener = $services->get('Auth/CheckPermissionsListener');
        $checkPermissionsListener->attach($eventManager);

        $unauthorizedAccessListener = $services->get('UnauthorizedAccessListener');
        $unauthorizedAccessListener->attach($eventManager);
         */

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
            $sharedManager->attach(
                array('Applications','CamMediaintown'),
                MvcEvent::EVENT_DISPATCH,
                function ($event) {
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

                },
                -2 /*postDispatch, but before most of the other zf2 listener*/
            );
        }

    }
}
