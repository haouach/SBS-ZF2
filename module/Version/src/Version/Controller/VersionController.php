<?php

namespace Version\Controller;

use Zend\Crypt\Password\Bcrypt;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,
    Version\Model\Version,
    Version\Form\VersionForm;


class VersionController extends AbstractActionController
{
	protected $versionTable;

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
        $save=false;
        $id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
		return $this->redirect()->toRoute('erreur');
		}

        $form = new VersionForm();
        $form->get('submit')->setValue('Ajouter');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $version = new Version();
            $form->setInputFilter($version->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $version->exchangeArray($form->getData());
                $this->getVersionTable()->saveVersion($version);
                // Redirect to list of versions
                $save=true;
            }
        }

        $view = new ViewModel(array(
            'versions' => $this->getVersionTable()->fetchAll($id),
            'form' => $form,
		    'save' => $save,
            'idprojet' => $id,      ));
        $view->setTerminal(true);


        return $view;

    }

    public function addAction()
    {
        $save=false;
        $this->sessionControle();
        $form = new VersionForm();
		$form->get('submit')->setValue('Ajouter');
		$request = $this->getRequest();
		if ($request->isPost()) {
		    $id=$_POST['idprojet'];
		}else{
		    $id = (int) $this->params()->fromRoute('id', 0);
		}
		if ($request->isPost()) {
		$version = new Version();
		$form->setInputFilter($version->getInputFilter());
		$form->setData($request->getPost());

		if ($form->isValid()) {

			$version->exchangeArray($form->getData());
			$this->getVersionTable()->saveVersion($version);
			// Redirect to list of versions
			$save=true;
		}
		}else{
		return $this->redirect()->toRoute('erreur');
		}
		$view = new ViewModel(array(
		    'versions' => $this->getVersionTable()->fetchAll($id),
		    'form' => $form,
		    'save' => $save,
		    'idprojet' => $id,
        ));
          $view->setTerminal(true);


        return $view;


    }

    public function editAction()
    {
        $this->sessionControle();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $id=$_POST['idversion'];
        }else{
            $id = (int) $this->params()->fromRoute('id', 0);
        }
        $save=false;
		if (!$id) {
			return $this->redirect()->toRoute('erreur');
		}
		$version = $this->getVersionTable()->getVersion($id);
		$form = new VersionForm();
		$form->bind($version);
		$form->get('submit')->setAttribute('value','Enregistrer');

		if ($request->isPost()) {
			$form->setInputFilter($version->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getVersionTable()->saveVersion($form->getData());
				// Redirect to list of versions
				$save=true;
			}
		}

		$view = new ViewModel(array(
		    		'versions' => $this->getVersionTable()->fetchAll($form->get('idprojet')->getValue()),
		    		'idprojet' => $form->get('idprojet')->getValue(),
		    		'idversion' => $id,
					'form' => $form,
		    		'save' => $save,
		));
		$view->setTerminal(true);

		return $view;
    }

    public function deleteAction()
    {
        $this->sessionControle();
        $id = (int) $this->params()->fromRoute('id', 0);
        $version = $this->getVersionTable()->getVersion($id);
		if (!$id) {
		return $this->redirect()->toRoute('erreur');
		}
		$request = $this->getRequest();
		$this->getVersionTable()->deleteVersion($id);
		return $this->redirect()->toRoute('version',array('id'=>$version->idprojet));

    }

    public function getVersionTable()
    {
        if (!$this->versionTable) {
            $sm = $this->getServiceLocator();
            $this->versionTable = $sm->get('Version\Model\VersionTable');
        }
        return $this->versionTable;
    }


}