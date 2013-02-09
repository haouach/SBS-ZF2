<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'user/user' => 'User\Controller\UserController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
						'controller' => 'user/user',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'misc' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/user/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'user/user',
                                'action'     => 'index',
                            ),
                        ),
                    ),
					'add' => array (
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'user/user',
                                'action'     => 'add',
                            ),
                        ),
                    ),


                ),
            ),
			'edit' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/user/edit/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'user/user',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
            'editer' => array (
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user/editer',
                    'defaults' => array(
                        'controller' => 'user/user',
                        'action'     => 'edit',
                    ),
                ),
            ),
			'delete' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/user/delete/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'user/user',
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
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
