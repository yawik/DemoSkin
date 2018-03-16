<?php
/**
 * Yawik DemoSkin
 */

/**  */
namespace YawikDemoSkin\Factory\Dependency;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;


/**
 *
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 */
class ManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $manager = new \YawikDemoSkin\Dependency\Manager($container->get('Core/DocumentManager'));
        $manager->setEventManager($container->get('Auth/Dependency/Manager/Events'));

        return $manager;
    }
}
