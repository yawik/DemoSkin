<?php
/**
 * YAWIK
 *
 * @filesource
 * @license MIT
 * @copyright  2013 - 2015 Cross Solution <http://cross-solution.de>
 */
  
/** */
namespace YawikDemoSkin\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ${CARET}
 * 
 * @author Carsten Bleek <bleek@cross-solution.de>
 * @todo write test 
 */
class ClassificationFieldsetFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator \Zend\ServiceManager\AbstractPluginManager */
        $services = $serviceLocator->getServiceLocator();
        $options  = $services->get('YawikDemoSkin/ClassificationOptions');

        $fs = new ClassificationFieldset('classifications', [
            'professions_values' => $options->professions,
            'types_values'       => $options->types,
        ]);

        return $fs;
    }


}