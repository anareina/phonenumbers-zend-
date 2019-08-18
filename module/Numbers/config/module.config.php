<?php

namespace Numbers;

use Zend\Router\Http\Segment;

return [
   
   'router' => [
        'routes' => [
            'numbers' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/numbers[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\NumbersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'numbers' => __DIR__ . '/../view',
        ],
    ],
];