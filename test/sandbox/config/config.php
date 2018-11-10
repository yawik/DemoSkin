<?php

chdir(dirname(__DIR__));
return [
    'modules' => \Core\Yawik::generateModuleConfiguration([
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
    'core_options' => [
        'systemMessageEmail' => 'developer@yawik.org',
    ],
];
