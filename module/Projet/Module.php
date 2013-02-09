<?php
namespace Projet;
// Add these import statements:
use Projet\Model\Projet;
use Projet\Model\ProjetTable;
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
                'Projet\Model\Projettable' =>  function($sm) {
                    $tableGateway = $sm->get('ProjetTableGateway');
                    $table = new ProjetTable($tableGateway);
                    return $table;
                },
                'ProjetTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Projet());
                    return new TableGateway('projet', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}