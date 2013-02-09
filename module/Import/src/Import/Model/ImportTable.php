<?php
namespace Import\Model;

use Zend\Db\TableGateway\TableGateway;

class ImportTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }



    public function deleteRow($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}