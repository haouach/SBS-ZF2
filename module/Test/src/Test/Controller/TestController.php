<?php

namespace Test\Controller;

use Zend\Crypt\Password\Bcrypt;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,
    Test\Model\Test,
    Test\Form\TestForm;


class TestController extends AbstractActionController
{
	protected $testTable;

public  function __autoload(){
    $this->sessionControle();
}
    public  function sessionControle(){

            if (!$this->zfcUserAuthentication()->hasIdentity()) {
                return $this->redirect()->toRoute('zfcuser/login');
            }

    }
    public function indexAction()
    {
        $this->sessionControle();
        return new ViewModel(array(
            'tests' => $this->getTestTable()->fetchAll()       ));
    }

    public function addAction()
    {
        $this->sessionControle();
        $form = new TestForm();
		$form->get('submit')->setValue('Ajouter');
		$request = $this->getRequest();
		if ($request->isPost()) {
		$test = new Test();
		$form->setInputFilter($test->getInputFilter());
		$form->setData($request->getPost());
		if ($form->isValid()) {

			$test->exchangeArray($form->getData());
			$this->getTestTable()->saveTest($test);
			// Redirect to list of tests
			return $this->redirect()->toRoute('test');
		}
		}
		return array('form' => $form,'menu' => 'test');

    }

    public function editAction()
    {
        $this->sessionControle();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id=$_POST['idtest'];
        }else{
            $id = (int) $this->params()->fromRoute('id', 0);
        }

		if (!$id) {
			return $this->redirect()->toRoute('test/add');
		}
		$test = $this->getTestTable()->getTest($id);
		$form = new TestForm();
		$form->bind($test);
		$form->get('submit')->setAttribute('value','Enregistrer');

		if ($request->isPost()) {
			$form->setInputFilter($test->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getTestTable()->saveTest($form->getData());
				// Redirect to list of tests
				return $this->redirect()->toRoute('test');
			}
		}
		return array(
					'idtest' => $id,
					'form' => $form
		);
    }

    public function deleteAction()
    {
        $this->sessionControle();
        $id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
		return $this->redirect()->toRoute('test');
		}
		$request = $this->getRequest();
		$this->getTestTable()->deleteTest($id);
		return $this->redirect()->toRoute('test');

    }

    public function getTestTable()
    {
        if (!$this->testTable) {
            $sm = $this->getServiceLocator();
            $this->testTable = $sm->get('Test\Model\TestTable');
        }
        return $this->testTable;
    }


}