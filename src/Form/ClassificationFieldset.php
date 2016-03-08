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

use Jobs\Entity\Hydrator\TemplateValuesHydrator;
use Zend\Form\Fieldset;
use Zend\ModuleManager\Feature\InputFilterProviderInterface;

/**
 * ${CARET}
 * 
 * @author Carsten Bleek <bleek@cross-solution.de>
 * @todo write test 
 */
class ClassificationFieldset extends Fieldset implements InputFilterProviderInterface
{
    protected $partial = 'yawik-demo-skin/classification';

    public function setViewPartial($partial)
    {
        $this->partial = $partial;

        return $this;
    }

    public function getViewPartial()
    {
        return $this->partial;
    }

    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->setHydrator(new TemplateValuesHydrator(['professions', 'types']));
        }

        return $this->hydrator;
    }

    public function init()
    {
        $this->setName('classification');

        $professions = $this->getOption('professions_values');
        $types       = $this->getOption('types_values');

        $this->add(
             array(
                 'type' => 'Select',
                 'name' => 'professions',
                 'options' => array(
                     'label' => /*@translate*/ 'Professions',
                     'value_options' => is_array($professions) ? $professions
                                        : [
                                             'n/a' => 'Keine Berufsfelder verfügbar'
                                          ],
                 ),
                 'attributes' => [
                     'multiple' => true,
                     'data-width' => '100%'
                 ]
             )
        );

        $this->add(
             array(
                 'type' => 'Select',
                 'name' => 'types',
                 'options' => array(
                     'label' => /*@translate*/ 'Contract',
                     'value_options' => is_array($types) ? $types
                             : [
                                 'n/a' => 'Keine Anstellungsart definiert.'
                             ],
                 ),
                 'attributes' => [
                     'data-searchbox' => -1,
                     'data-width' => '100%'
                 ]
             )
        );
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getInputFilterConfig()
    {
        return [
            'professions' => [ 'required' => true ],
            'types' => [ 'required' => true ],
        ];
    }


}