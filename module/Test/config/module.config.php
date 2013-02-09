<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'test/test' => 'Test\Controller\TestController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'test' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/test',
                    'defaults' => array(
						'controller' => 'test/test',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'misc' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/test/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'test/test',
                                'action'     => 'index',
                            ),
                        ),
                    ),
					'add' => array (
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'test/test',
                                'action'     => 'add',
                            ),
                        ),
                    ),


                ),
            ),
			'edittest' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/test/edit/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'test/test',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
            'editertest' => array (
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/test/editer',
                    'defaults' => array(
                        'controller' => 'test/test',
                        'action'     => 'edit',
                    ),
                ),
            ),
			'deletetest' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/test/delete/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'test/test',
                                'action'     => 'delete',
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
          //  'layout/layout'           => __DIR__ . '/../../projet/view/layout/layout.phtml',
            'test/index/index' => __DIR__ . '/../view/test/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
