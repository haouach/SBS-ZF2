<?php

namespace Import\Controller;

use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel;

class ImportController extends AbstractActionController
{
	protected $ImportTable;

    public function indexAction()
    {
		 return new ViewModel(array(
            'data' => $this->getimportTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }

    public function getimportTable()
    {
        if (!$this->importTable) {
            $sm = $this->getServiceLocator();
            $this->importTable = $sm->get('Import\Model\ImportTable');
        }
        return $this->ImportTable;
    }
}