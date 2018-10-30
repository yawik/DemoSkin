<?php

chdir(__DIR__.'/../sandbox');
return [
    'modules' => \Core\Bootstrap::generateModuleConfiguration([
        'Core',
        'Cv',
        'Auth',
        'Jobs',
        'Applications',
        'Settings',
        'Organizations',
        'Geo',
        'YawikDemoSkin',
    ]),
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],

        // What configuration files should be autoloaded
        'config_glob_paths' => array(
            __DIR__.'/autoload/{,*.}{global,local}.php',
        ),
        'cache_dir' => realpath(__DIR__.'/../sandbox').'/var/cache'
    ],
    'core_options' => [
        'systemMessageEmail' => 'developer@yawik.org',
    ],
];
