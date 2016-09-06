<?php
/**
 * Yawik DemoSkin
 */

/** */
namespace YawikDemoSkin\Dependency;

use Auth\Dependency\Manager as AuthDependencyManager;
use Auth\Entity\User;

/**
 *
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 */
class Manager extends AuthDependencyManager
{

    /**
     * @param User $user
     * @param Router $router
     * @return \Zend\EventManager\ResponseCollection
     */
    public function removeItems(User $user)
    {
        // removal of standard users are not allowed in the demo
        return
            in_array($user->getLogin(), ['demo', 'applicant', 'admin'])
            ? false : parent::removeItems($user);
    }
}
