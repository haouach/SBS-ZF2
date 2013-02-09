<?php

namespace ZfcUser\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use ZfcUser\Entity\UserInterface as UserEntityInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class User extends AbstractDbMapper implements UserInterface
{
    protected $tableName  = 'user';
    protected $fieldNames = array(
                'id'=>'iduser',
                'email'=>'email',
                'username'=>'username',
        		'prenom'=>'display_name',
        		'previlege'=>'previlege'
           );

    public function findByEmail($email)
    {
        $select = $this->getSelect()
                       ->where(array($this->fieldNames['email'] => $email));
        			   //->where(array('email' => $email));


        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function findByUsername($username)
    {
        $select = $this->getSelect()
        			   ->where(array($this->fieldNames['username'] => $username));
                       //->where(array('username' => $username));

        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function findById($id)
    {
        $select = $this->getSelect()
        			   ->where(array($this->fieldNames['id'] => $id));
                       //->where(array('iduser' => $id));

        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {

        $result = parent::insert($entity, $tableName, $hydrator);
        print_r($result);
        die;exit;
        $entity->setId($result->getGeneratedValue());
        return $result;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            //$where = 'iduser = ' . $entity->getId();
            $where = array($this->fieldNames['id'] => $entity->getId() );
        }

        return parent::update($entity, $where, $tableName, $hydrator);
    }
}
