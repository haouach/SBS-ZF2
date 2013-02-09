<?php

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
	protected $LoginTable;

    public function indexAction()
    {
		 return new ViewModel(array(
            'Logins' => $this->getLoginTable()->fetchAll(),
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
    // module/Album/src/Login/Controller/AlbumController.php:
    public function getLoginTable()
    {
        if (!$this->loginTable) {
            $sm = $this->getServiceLocator();
            $this->loginTable = $sm->get('Login\Model\LoginTable');
        }
        return $this->loginTable;
    }
}