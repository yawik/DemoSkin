<?php
/**
 * Yawik DemoSkin
 */

/**  */
namespace YawikDemoSkin\Factory\Dependency;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 *
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 */
class ManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $manager = new \YawikDemoSkin\Dependency\Manager($serviceLocator->get('Core/DocumentManager'));
        $manager->setEventManager($serviceLocator->get('Auth/Dependency/Manager/Events'));
        
        return $manager;
    }
}
