<?php
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
        'cache_dir' => __DIR__.'/../cache'
    ],
    'core_options' => [
        'logDir' => __DIR__.'/../log',
        'cacheDir' => __DIR__.'/../cache',
        'publicDir' => __DIR__.'/../sandbox/public',
        'system_message_email' => 'developer@yawik.org',
        'systemMessageEmail' => 'developer@yawik.org',
    ],
    'log' => [
        'Core/Log' => [
            'writers' => [
                [
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => array(
                        'stream' => __DIR__.'/../log/yawik.log',
                    ),
                ]
            ]
        ]
    ],
];
