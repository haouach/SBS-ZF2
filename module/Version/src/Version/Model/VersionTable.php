<?php
namespace Version\Model;

use Zend\Db\TableGateway\TableGateway;

class VersionTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($id)
    {
        $resultSet = $this->tableGateway->select(array('idprojet' => $id));
        return $resultSet;
    }

    public function getVersion($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idversion' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveVersion(Version $version)
    {
        $data = array(
            'idprojet' => $version->idprojet,
            'titreversion' => $version->titreversion,
            'date' => $version->date,
        );

        $id = (int)$version->idversion;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getVersion($id)) {
                $this->tableGateway->update($data, array('idversion' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteVersion($id)
    {
        $this->tableGateway->delete(array('idversion' => $id));
    }
}