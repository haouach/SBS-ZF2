<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'version/version' => 'Version\Controller\VersionController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'version' => array(
                'type'    => 'segment',
                'options' => array(
                    'route' => '/listeversion/[:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
						'controller' => 'version/version',
                        'action' => 'index',
                    ),
                ),

            ),
            'addversion' => array (
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/version/add',
                    'defaults' => array(
                        'controller' => 'version/version',
                        'action'     => 'add',
                    ),
                ),
            ),
			'editversion' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/version/edit/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'version/version',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
            'editerversion' => array (
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/version/editer',
                    'defaults' => array(
                        'controller' => 'version/version',
                        'action'     => 'edit',
                    ),
                ),
            ),
			'deleteversion' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/version/delete/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'version/version',
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
            'version/index/index' => __DIR__ . '/../view/version/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
