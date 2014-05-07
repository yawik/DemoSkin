<?php

namespace YawikDemoSkin;

use Zend\Mvc\MvcEvent;

/**
 * Bootstrap class of our demo skin
 */
class Module
{
   function getConfig()
   {
       return include __DIR__ . '/config/module.config.php';
   } 
}
