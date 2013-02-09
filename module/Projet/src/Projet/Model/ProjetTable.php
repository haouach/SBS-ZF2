<?php
namespace Projet\Model;

use Zend\Db\TableGateway\TableGateway;

class ProjetTable
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

    public function getProjet($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('idprojet' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveProjet(Projet $projet)
    {
        $data = array(
            'nomprojet' => $projet->nomprojet,
        );

        $id = (int)$projet->idprojet;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProjet($id)) {
                $this->tableGateway->update($data, array('idprojet' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteProjet($id)
    {
        $this->tableGateway->delete(array('idprojet' => $id));
    }
}