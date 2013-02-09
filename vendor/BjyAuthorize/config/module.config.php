<?php
/**
 * BjyAuthorize Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'bjyauthorize' => array(
        'default_role'          => 'visiteur',
        'identity_provider'     => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',
        'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',

        'role_providers' => array(

            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
			 */
            'BjyAuthorize\Provider\Role\Config' => array(
                'user' => array(),
                'admin'  => array(),
                'visiteur'  => array(),
             ),
            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar), parent(varchar))
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            ),



         ),



        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'pants' => array(),
            ),
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('user', 'admin'), 'pants', 'wear')
                ),

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    // ...
                ),
            ),
        ),
        /* Currently, only controller and route guards exist
         */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            'BjyAuthorize\Guard\Controller' => array(
                array('controller' => 'zfcuser', 'action' => 'login', 'roles' => array('visiteur')),
                array('controller' => 'zfcuser', 'action' => 'logout', 'roles' => array('admin','user')),
                array('controller' => 'zfexcel', 'action' => 'index', 'roles' => array('admin','user')),
                array('controller' => 'zfexcel', 'action' => 'add', 'roles' => array('admin','user')),
                array('controller' => 'zfexcel', 'action' => 'read', 'roles' => array('admin','user')),
                array('controller' => 'user/user', 'action' => 'index', 'roles' => array('admin','user')),
                array('controller' => 'user/user', 'action' => 'add', 'roles' => array('admin','user')),
                array('controller' => 'user/user', 'action' => 'edit', 'roles' => array('admin','user')),
                array('controller' => 'user/user', 'action' => 'delete', 'roles' => array('admin','user')),
                array('controller' => 'user/user', 'action' => 'editer', 'roles' => array('admin','user')),
                array('controller' => 'test/test', 'action' => 'index', 'roles' => array('admin','user')),
                array('controller' => 'test/test', 'action' => 'add', 'roles' => array('admin','user')),
                array('controller' => 'test/test', 'action' => 'edit', 'roles' => array('admin','user')),
                array('controller' => 'test/test', 'action' => 'delete', 'roles' => array('admin','user')),
                array('controller' => 'test/test', 'action' => 'editer', 'roles' => array('admin','user')),
                array('controller' => 'projet/projet', 'action' => 'index', 'roles' => array('admin','user')),
                array('controller' => 'projet/projet', 'action' => 'add', 'roles' => array('admin','user')),
                array('controller' => 'projet/projet', 'action' => 'edit', 'roles' => array('admin','user')),
                array('controller' => 'projet/projet', 'action' => 'delete', 'roles' => array('admin','user')),
                array('controller' => 'projet/projet', 'action' => 'editer', 'roles' => array('admin','user')),
                array('controller' => 'version/version', 'action' => 'index', 'roles' => array('admin','user')),
                array('controller' => 'version/version', 'action' => 'add', 'roles' => array('admin','user')),
                array('controller' => 'version/version', 'action' => 'edit', 'roles' => array('admin','user')),
                array('controller' => 'version/version', 'action' => 'delete', 'roles' => array('admin','user')),
                array('controller' => 'version/version', 'action' => 'editer', 'roles' => array('admin','user')),

                // Below is the default index action used by the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
                // array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
            ),

            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
           /* 'BjyAuthorize\Guard\Route' => array(
                array('route' => 'zfcuser', 'roles' => array('admin')),
                array('route' => 'user', 'roles' => array('user')),
                array('route' => 'test/edit', 'roles' => array('user')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('visiteur')),
                array('route' => 'zfcuser/register', 'roles' => array('user')),
                // Below is the default index action used by the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
                array('route' => 'home', 'roles' => array('user', 'admin')),
            ),*/
        ),

        'template'              => 'error/403',
    ),
    'service_manager' => array(
        'aliases' => array(
            'bjyauthorize_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
        'factories' => array(
            'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider' => 'BjyAuthorize\Service\AuthenticationIdentityProviderServiceFactory'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'error/403' => __DIR__ . '/../view/error/403.phtml',
        ),
    ),
);

