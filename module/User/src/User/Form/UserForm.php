<?php
namespace User\Form;
use Zend\Form\Form;

class UserForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

		$decorators = array(
			'ViewHelper',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array('HtmlTag', array('tag' => 'td')),
			array('Label', array('tag' => 'th')),
			array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
		);

        $this->add(array(
						'name' => 'iduser',
						'attributes' => array(
											'type' => 'hidden',
						),
        ));

		$this->add(array(
						'name' => 'etat',
						'attributes' => array(
											'type' => 'hidden',
											'value' => '1',
						),
        ));

		$this->add(array(
						'name' => 'password',
						'attributes' => array(
											'type' => 'hidden',
											'value' => '',
						),
        ));

        $this->add(array(
						'name' => 'nom',
						'attributes' => array(
											'type' => 'text',
											'label' => 'Nom',
											'class' => 'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));

        $this->add(array(
						'name' => 'prenom',
						'decorators' => array(
									'ViewHelper',
									array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
									array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
								),

						'attributes' => array(
											'type' => 'text',
											'label' => 'Prénom',
											'class' =>'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));

		$this->add(array(
						'name' => 'email',
						'attributes' => array(
											'type' => 'text',
											'label' => 'Email',
											'class' =>'st-forminput tips-right',
											'id' => 'textfield2',
											'style' => 'width:300px',
						),
        ));


		$this->add(array(
						 'type' => 'Zend\Form\Element\Radio',
						 'name' => 'previlege',
						 'attributes' => array(
											'class' =>'uniform',
						),
						 'options' => array(
										 'value_options' => array(
																 'admin' => 'Administrateur',
																 'user' => 'Utilisateur',
										 ),
										 'separator' => "</li>\n<li>",

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
