<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'import/import' => 'Import\Controller\ImportController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'import' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/import',
                    'defaults' => array(
						'controller' => 'import/import',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'misc' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/import/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'import/import',
                                'action'     => 'index',
                            ),
                        ),
                    ),
					'add' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'import/import',
                                'action'     => 'add',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // View setup for this module

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'import/index/index' => __DIR__ . '/../view/import/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
