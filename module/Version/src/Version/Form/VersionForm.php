<?php
namespace Version\Form;
use Zend\Form\Form;

class VersionForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('version');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'version');

		$decorators = array(
			'ViewHelper',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array('HtmlTag', array('tag' => 'td')),
			array('Label', array('tag' => 'th')),
			array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
		);

        $this->add(array(
						'name' => 'idversion',
						'attributes' => array(
											'type' => 'hidden',
						),
        ));

        $this->add(array(
            'name' => 'idprojet',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));


        $this->add(array(
						'name' => 'titreversion',
						'attributes' => array(
											'type' => 'text',
											'label' => 'Nom',
											'class' => 'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));

        $this->add(array(
            'name' => 'date',
            'attributes' => array(
                'type' => 'text',
                'id' => 'datepicker',
                'class' => 'datepicker-input',
                'value' => '',
                'style' => 'width:180px',
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
