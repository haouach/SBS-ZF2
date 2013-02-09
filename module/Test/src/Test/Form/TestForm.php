<?php
namespace Test\Form;
use Zend\Form\Form;

class TestForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('test');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'test');

		$decorators = array(
			'ViewHelper',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array('HtmlTag', array('tag' => 'td')),
			array('Label', array('tag' => 'th')),
			array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
		);

        $this->add(array(
						'name' => 'idtest',
						'attributes' => array(
											'type' => 'hidden',
						),
        ));


        $this->add(array(
						'name' => 'titretest',
						'attributes' => array(
											'type' => 'text',
											'label' => 'Nom',
											'class' => 'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));

        $this->add(array(
						'name' => 'description',
						'decorators' => array(
									'ViewHelper',
									array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
									array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
								),

						'attributes' => array(
											'type' => 'textarea',
											'label' => 'Description',
						    				'cols'  => '75',
						    				'rows'  => '5',
											'class' =>'st-forminput',
											'id' => 'wysiwyg',
											'style' => 'width: 100%; display: none;',
						),
        ));

        $this->add(array(
            'attributes' => array(
                'type' => 'text',
                'id' => 'datepicker',
                'class' => 'datepicker-input',
                'value' => '',
                'style' => 'width:180px',
            ),
            'name' => 'date',
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
