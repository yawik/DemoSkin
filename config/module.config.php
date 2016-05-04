<?php


\YawikDemoSkin\Module::$isLoaded = true;

/**
 * create a config/autoload/YawikDemoSkin.global.php and put modifications there
 */

return array('view_manager' => array(
                 'template_map' => array(
                     'layout/layout' => __DIR__ . '/../view/layout.phtml',
                     'core/index/index' => __DIR__ . '/../view/index.phtml',
                     'auth/password/index' => __DIR__ . '/../view/password.phtml',
                     'piwik' => __DIR__ . '/../view/piwik.phtml',
                     'iframe/iFrame.phtml'               => __DIR__ . '/../view/iFrame.phtml',
                     'jobs/jobboard/index.ajax.phtml' => __DIR__ . '/../view/jobs/index.ajax.phtml',
                     'auth/users/list.ajax.phtml' => __DIR__ . '/../view/auth/users/list.ajax.phtml', // hide email adresses, since this is is a public demo
                      ),
             ),
             'translator' => array(
                 'translation_file_patterns' => array(
                      array(
                          'type' => 'gettext',
                           'base_dir' => __DIR__ . '/../language',
                           'pattern' => '%s.mo',
                            ),
                      ),
                 ),


             'form_elements' => [
                 'invokables' => [
                     'YawikDemoSkin/ClassificationForm' => 'YawikDemoSkin\Form\ClassificationForm',
                     'Jobs/Description' => 'YawikDemoSkin\Form\JobsDescription',
                 ],
                 'factories' => [
                     'YawikDemoSkin/ClassificationFieldset' => 'YawikDemoSkin\Form\ClassificationFieldsetFactory',
                 ],
             ],

);
