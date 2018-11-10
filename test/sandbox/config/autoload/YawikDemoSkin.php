<?php

if (!\YawikDemoSkin\Module::$isLoaded) {
    return array();
}

/**
 * The location of the Piwik Code.
 */
return [
    'view_manager' => [
        'template_map' => [
            'piwik' => realpath(__DIR__ . '/../../../../view/piwik.phtml')
        ]
    ],
    'acl' => [
        'rules' => [
            // guests are allowed to see a list of companies.
            'guest' => [
                'deny' => [
                    'route/lang/organizations',
                ],
            ],
        ],
    ],
];
