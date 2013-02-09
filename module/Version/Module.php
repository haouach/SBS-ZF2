<?php
namespace Version;
// Add these import statements:
use Version\Model\Version;
use Version\Model\VersionTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{



    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Version\Model\Versiontable' =>  function($sm) {
                    $tableGateway = $sm->get('VersionTableGateway');
                    $table = new VersionTable($tableGateway);
                    return $table;
                },
                'VersionTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Version());
                    return new TableGateway('version', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}