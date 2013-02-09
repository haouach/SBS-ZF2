<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'projet/projet' => 'Projet\Controller\ProjetController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'projet' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/projet',
                    'defaults' => array(
						'controller' => 'projet/projet',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'misc' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/projet/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'projet/projet',
                                'action'     => 'index',
                            ),
                        ),
                    ),
					'add' => array (
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'projet/projet',
                                'action'     => 'add',
                            ),
                        ),
                    ),


                ),
            ),
			'editprojet' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/projet/edit/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'projet/projet',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
            'editerprojet' => array (
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/projet/editer',
                    'defaults' => array(
                        'controller' => 'projet/projet',
                        'action'     => 'edit',
                    ),
                ),
            ),
			'deleteprojet' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/projet/delete/[:id]',
                            'constraints' => array(
								'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'projet/projet',
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
            'projet/index/index' => __DIR__ . '/../view/projet/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
