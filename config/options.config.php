<?php

/**
 * $professions is a category with two levels. $types has only one level.
 */

$professions = [
    'my_group_1' => [
        'label' => 'IT',
        'options' => [
            '1'  => /*@translate*/ 'Software Development',
            '2'  => /*@translate*/ 'System Administration',
        ],
    ],
    'my_group_2' => [
        'label' => 'Sales/Marketing',
        'options' => [
            '3'  => /*@translate*/ 'Sales',
            '4'  => /*@translate*/ 'Marketing',
        ]
    ],
];

$types = [
    'fulltime'   => /*@translate*/ 'full time',
    'parttime'   => /*@translate*/ 'part time',
    'freelancer' => /*@translate*/ 'freelancer',
    'students'   => /*@translate*/ 'apprenticeship',
    'internship' => /*@translate*/ 'internship',
    'temporary'  => /*@translate*/ 'temporary',
    'minijob'    => /*@translate*/ 'mini job',
];

//
// Do not change below this line!
//

return [
    'options' => [
        'YawikDemoSkin/ClassificationOptions' => [
            'class' => '\YawikDemoSkin\Form\ClassificationOptions',
            'options' => [
                'professions' => $professions,
                'types'       => $types,
            ],
        ],
    ],
];
