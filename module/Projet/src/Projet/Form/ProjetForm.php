<?php
namespace Projet\Form;
use Zend\Form\Form;

class ProjetForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('projet');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'projet');

		$decorators = array(
			'ViewHelper',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array('HtmlTag', array('tag' => 'td')),
			array('Label', array('tag' => 'th')),
			array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
		);

        $this->add(array(
						'name' => 'idprojet',
						'attributes' => array(
											'type' => 'hidden',
						),
        ));


        $this->add(array(
						'name' => 'nomprojet',
						'attributes' => array(
											'type' => 'text',
											'label' => 'Nom',
											'class' => 'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));


        $this->add(array(
						'name' => 'submit',
						'attributes' => array(
											'type' => 'submit',
											'value' => 'Ajouter',
											'class' => 'st-button',
											'id' => 'button',
						),
        ));



	}

}
