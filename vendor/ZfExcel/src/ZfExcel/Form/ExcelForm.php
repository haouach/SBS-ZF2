<?php
namespace ZfExcel\Form;

use Zend\Form\Form;

class ExcelForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Excel');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Excel Name',
            ),
        ));


        $this->add(array(
            'name' => 'path',
            'attributes' => array(
                'type'  => 'file',
                'class' => 'uniform',
            ),
            'options' => array(
                'label' => 'File Upload',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Upload Now',
                'class' => 'st-button',
            ),
        ));
    }
}
