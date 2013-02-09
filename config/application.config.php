<?php
return array(
    'modules' => array(
        'Album',
        'Application',
		'User',
        'Test',
        'Projet',
        'Version',
        'ZfcBase',
        'ZfcUser',
        'BjyAuthorize',
        'ZfExcel',

        //'Login',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
