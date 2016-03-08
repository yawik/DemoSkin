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

use Zend\Stdlib\AbstractOptions;

/**
 * ${CARET}
 * 
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 * @todo write test 
 */
class ClassificationOptions extends AbstractOptions
{

    protected $professions;

    protected $types;

    /**
     * @param mixed $professions
     *
     * @return self
     */
    public function setProfessions($professions)
    {
        $this->professions = $professions;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfessions()
    {
        return $this->professions;
    }

    /**
     * @param mixed $types
     *
     * @return self
     */
    public function setTypes($types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }
}