<?php

namespace ZfExcel;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use ZfExcel\Model\ExcelTable;
use Zend\Db\TableGateway\TableGateway;
use ZfExcel\Model\Excel;


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
                'ZfExcel\Model\ExcelTable' =>  function($sm) {
                    $tableGateway = $sm->get('ExcelTableGateway');
                    $table = new ExcelTable($tableGateway);
                    return $table;
                },
                'ExcelTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Excel());
                    return new TableGateway('excel', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}