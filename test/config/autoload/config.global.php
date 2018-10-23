<?php
$manifestFile = __DIR__.'/../../sandbox/public/build/manifest.json';
if (!is_dir($dir=dirname($manifestFile))) {
    mkdir($dir, 0755, true);
}
if (!is_file($manifestFile)) {
    file_put_contents($manifestFile, '{}', LOCK_EX);
}
return [
    'doctrine' =>[
        'connection' =>[
            'odm_default' =>[
                'connectionString' => 'mongodb://localhost:27017/YAWIK_TEST',
            ]
        ],
        'configuration' => [
            'odm_default' => [
                'default_db'    => 'YAWIK_TEST',
                'proxy_dir'     => __DIR__.'/../../cache/DoctrineMongoODMModule/Proxy',
                'hydrator_dir'  => __DIR__.'/../../cache/DoctrineMongoODMModule/Hydrator',
            ]
        ],
    ],
    'core_options' => [

    ],
    'view_helper_config' => [
        'asset' => [
            'resource_map' => json_decode(file_get_contents($manifestFile), true),
        ]
    ]
];
