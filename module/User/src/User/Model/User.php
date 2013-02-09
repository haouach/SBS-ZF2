<?php
namespace User\Model;

use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

class User implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $iduser;
	public $nom;
	public $prenom;
	public $email;
	public $password;
	public $previlege;
	public $etat;

	public function exchangeArray($data)
	{
	$this->iduser = (isset($data['iduser'])) ? $data['iduser'] : null;
	$this->nom = (isset($data['nom'])) ? $data['nom'] : null;
	$this->prenom = (isset($data['prenom'])) ? $data['prenom'] : null;
	$this->email = (isset($data['email'])) ? $data['email'] : null;
	$this->password = (isset($data['password'])) ? $data['password'] : null;
	$this->previlege = (isset($data['previlege'])) ? $data['previlege'] : null;
	$this->etat = (isset($data['etat'])) ? $data['etat'] : null;
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
                'name' => 'iduser',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'nom',
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
                'name' => 'prenom',
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
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
					array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

			 $inputFilter->add($factory->createInput(array(
			     'name' => 'password',
			     'required' => false,
			     'filters' => array(
			         array('name' => 'StripTags'),
			         array('name' => 'StringTrim'),
			     ),
			     'validators' => array(
			         array(
			             'name' => 'StringLength',
			             'options' => array(
			                 'encoding' => 'UTF-8',
			                 'max' => 100,
			             ),
			         ),
			     ),
			 )));

			 $inputFilter->add($factory->createInput(array(
                'name' => 'previlege',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),

            )));

			 $inputFilter->add($factory->createInput(array(
			     'name' => 'etat',
			     'required' => false,
			     'filters' => array(
			         array('name' => 'Int'),
			     ),
			     'validators' => array(
			         array(
			             'name' => 'StringLength',
			             'options' => array(
			                 'encoding' => 'UTF-8',
			                 'min' => 1,
			                 'max' => 1,
			             ),
			         ),
			     ),
			 )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

function generatePassword ($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "012346789abcdfghjkmnpqrtvwxyzABCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);

      // have we already used this character in $password?
      if (!strstr($password, $char)) {
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }



}