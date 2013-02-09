<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'zfexcel' => 'ZfExcel\Controller\ExcelController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'zfexcel' => __DIR__ . '/../view',
        ),
    ),

    'router' => array(
        'routes' => array(
            'zfexcel' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/excel',
                    'defaults' => array(
                        'controller' => 'zfexcel',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'controller' => 'zfexcel',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                   'read' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/read-[:id]',

                            'constraints' => array(
                                'param'  => '[0-9]+',
                    		),

                            'defaults' => array(
                                'controller' => 'zfexcel',
                                'action'     => 'read',
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ),
);