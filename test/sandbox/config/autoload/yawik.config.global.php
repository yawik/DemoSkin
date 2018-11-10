<?php

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
            ]
        ],
    ],
    "core_options" => [
        'system_message_email' => "dev@yawik.dev",
    ]
];
