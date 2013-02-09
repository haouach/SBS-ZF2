<?php
namespace Version\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class Version implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $idversion;
	public $idprojet;
	public $titreversion;
	public $date;

	public function exchangeArray($data)
	{
	    $this->idversion = (isset($data['idversion'])) ? $data['idversion'] : null;
	    $this->idprojet = (isset($data['idprojet'])) ? $data['idprojet'] : null;
		$this->titreversion = (isset($data['titreversion'])) ? $data['titreversion'] : null;
		$this->date = (isset($data['date'])) ? $data['date'] : null;
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
                'name' => 'idversion',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'idprojet',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'titreversion',
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

            $inputFilter->add($factory->createInput(array(
                'name' => 'date',
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
                            'min' => 10,
                            'max' => 10,
                        ),
                    ),
                ),
            )));




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}