<?php
/**
 * YAWIK
 *
 * @filesource
 * @license MIT
 * @copyright  2013 - 2015 Cross Solution <http://cross-solution.de>
 */
  
/** */
namespace YawikDemoSkin\Factory\Form;

use Zend\Form\Element\Select;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ${CARET}
 * 
 * @author Carsten Bleek <bleek@cross-solution.de>
 * @todo write test 
 */
class ClassificationTypesSelectFactory implements FactoryInterface
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

        $select = new Select();

        $select->setValueOptions($options->types);
        $select->setAttribute('data-allowclear', true);
        $select->setAttribute('data-placeholder', /*translate*/ 'Types');
        $select->setAttribute('multiple', true);

        return $select;
    }


}