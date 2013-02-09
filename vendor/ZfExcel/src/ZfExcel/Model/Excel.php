<?php

namespace ZfExcel\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Excel implements InputFilterAwareInterface
{
    public $idexcel;
    public $path;
    public $name;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->idexcel = (isset($data['idexcel'])) ? $data['idexcel'] : null;
        $this->name  = (isset($data['name']))  ? $data['name']     : null;
        $this->path  = (isset($data['path']))  ? $data['path']     : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'name',
                    'required' => true,
                    'filters'  => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100,
                            ),
                        ),
                    ),
                ))
            );

            $inputFilter->add(
                $factory->createInput(array(
                    'name'     => 'path',
                    'required' => true,
                ))
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
