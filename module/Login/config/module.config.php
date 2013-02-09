<?php

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'login/login' => 'Login\Controller\LoginController',
        ),
    ),


    // Routes for this module
    'router' => array(
        'routes' => array(
            'album' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'login/login',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'misc' => array (
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/login/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'login/login',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'login' => __DIR__ . '/../view',
        ),
    ),
);
