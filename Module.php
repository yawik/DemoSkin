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
            // add suffix for logins
            $sharedManager = $eventManager->getSharedManager();
            $sharedManager->attach(
                array('Auth','Jobs'),
                'login.getSuffix',
                function ($event) {
                    return '@ams';
                }
            );

            // own Interpretation of the Subscriber
            $sharedManager->attach(
                'CamMediaintown\Controller\ApplyController',
                MvcEvent::EVENT_DISPATCH,
                function ($event) {
                    $request        = $event->getRequest();
                    $query          = $request->getQuery();
                    $serviceManager = $event->getTarget()->getServiceLocator();
                    $config         = $serviceManager->get('config');
                    if (isset($config['CamMediaintown']['subscriber_uri_tmpl'])) {
                        $portal = $query->get('portal', 0);
                        if (0 < $portal) {
                            $url = sprintf($config['CamMediaintown']['subscriber_uri_tmpl'], $portal);
                            $query->set('subscriber', $url);
                        }
                    }
                },
                1000
            );

            // Login-Mails sollen per BCC an Herr Rentsch gehen
            $sharedManager->attach(
                'Mail',
                'template.pre',
                function ($event) {
                    $mail = $event->getParam('mail');
                    if (isset($mail)) {
                        $template = $event->getParam('template');
                        if ($template == "first-login") {
                            $controller = $mail->getController();
                            $services = $controller->getServiceLocator();
                            $config = $services->get('config');
                            if (!empty($config['CamMediaintown.bcc'])) {
                                $mail->setBcc($config['CamMediaintown.bcc']);
                            }
                        }
                    }
                    return;
                }
            );

            $sharedManager->attach(
                array('Applications'),
                MvcEvent::EVENT_DISPATCH,
                function ($event) use ($config) {
                    $portal = $event->getRequest()->getQuery('portal', 0);
                    if ($portal != 0) {
                        if (array_key_exists('CamMediaintown.rest.portal', $config)) {
                            $camMediaintown_rest_portal = sprintf($config['CamMediaintown.rest.portal'], $portal);
                            $query = $event->getRequest()->getQuery();
                            $query->set('subscriberUri', $camMediaintown_rest_portal);
                            //$event->getRequest()->setQuery($query);
                        }
                    }
                    return;
                },
                100
            );

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
