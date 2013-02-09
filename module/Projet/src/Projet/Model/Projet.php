<?php
namespace Projet\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Projet implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $idprojet;
	public $nomprojet;

	public function exchangeArray($data)
	{
	$this->idprojet = (isset($data['idprojet'])) ? $data['idprojet'] : null;
	$this->nomprojet = (isset($data['nomprojet'])) ? $data['nomprojet'] : null;
	}


	public function getArrayCopy()
	{
	    return get_object_vars($this);
	}

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'idprojet',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'nomprojet',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}