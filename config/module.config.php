<?php

/**
 * create a config/autoload/YawikDemoSkin.global.php and put modifications there
 */

return array('view_manager' => array(
                 'template_map' => array(
                     'layout/layout' => __DIR__ . '/../view/layout.phtml',
                     'piwik' => __DIR__ . '/../view/piwik.phtml'
                      ),
             ),
);