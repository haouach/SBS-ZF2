<?php
namespace Test\Model;

use Zend\Db\TableGateway\TableGateway;

class TestTable
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

    public function getTest($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idtest' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveTest(Test $test)
    {
        $data = array(
            'titretest' => $test->titretest,
            'date'  => $test->date,
            'description'  => $test->description,
        );

        $id = (int)$test->idtest;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getTest($id)) {
                $this->tableGateway->update($data, array('idtest' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteTest($id)
    {
        $this->tableGateway->delete(array('idtest' => $id));
    }
}