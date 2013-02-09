<?php

namespace ZfcUser\Mapper;

use Zend\Stdlib\Hydrator\ClassMethods;
use ZfcUser\Entity\UserInterface as UserEntityInterface;

class UserHydrator extends ClassMethods
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof UserEntityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }
        /* @var $object UserInterface*/
        $data = parent::extract($object);
        $data = $this->mappedData($data);
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return UserInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof UserEntityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of ZfcUser\Entity\UserInterface');
        }

        $data = $this->mappedData($data);

        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }
    protected function mappedData(array $data)
    {
        $data = $this->mapField('iduser', 'id', $data);
        $data = $this->mapField('nom', 'username', $data);
        $data = $this->mapField('etat', 'state', $data);
        $data = $this->mapField('previlege', 'previlege', $data);
        $data = $this->mapField('prenom', 'display_name', $data);
        return $data;
    }
}
