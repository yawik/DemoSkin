<?php


\YawikDemoSkin\Module::$isLoaded = true;

/**
 * create a config/autoload/YawikDemoSkin.global.php and put modifications there
 */

return array(
    'service_manager' => [
        'factories' => [
            'Auth/Dependency/Manager' => 'YawikDemoSkin\Factory\Dependency\ManagerFactory',
        ],
    ],
    'view_manager' => array(
                 'template_map' => array(
                     'startpage' => __DIR__ . '/../view/layout.phtml',
                     'layout/layout' => __DIR__ . '/../view/layout.phtml',
                     'used_modules' => __DIR__ . '/../view/used_modules.phtml',
                     'layout/application-form' => __DIR__ . '/../view/application-form.phtml',
                     'core/index/index' => __DIR__ . '/../view/index.phtml',
                     'auth/password/index' => __DIR__ . '/../view/password.phtml',
                     'piwik' => __DIR__ . '/../view/piwik.phtml',
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
                     'Jobs/Description' => 'YawikDemoSkin\Form\JobsDescription',
                 ],
             ],

);
