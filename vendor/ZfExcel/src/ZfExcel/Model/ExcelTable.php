<?php
namespace ZfExcel\Model;

use Zend\Db\TableGateway\TableGateway;

class ExcelTable
{
    public $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getExcel($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idexcel' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveExcel(Excel $excel)
    {
        $data = array(
            'name' => $excel->name,
            'path'  => $excel->path,

        );

        $id = (int)$excel->idexcel;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $id=$this->tableGateway->getLastInsertValue();
        } else {
            if ($this->getExcel($id)) {
                $this->tableGateway->update($data, array('idexcel' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
        return $id;
    }

    public function deleteExcel($id)
    {
        $this->tableGateway->delete(array('idexcel' => $id));
    }
}