<?php

namespace Projet\Controller;

use Zend\Crypt\Password\Bcrypt;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,
    Projet\Model\Projet,
    Projet\Form\ProjetForm;


class ProjetController extends AbstractActionController
{
	protected $projetTable;

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
            'projets' => $this->getProjetTable()->fetchAll()       ));

    }

    public function addAction()
    {
        $save=false;
        $this->sessionControle();
        $form = new ProjetForm();
		$form->get('submit')->setValue('Ajouter');
		$request = $this->getRequest();
		if ($request->isPost()) {
		$projet = new Projet();
		$form->setInputFilter($projet->getInputFilter());
		$form->setData($request->getPost());

		if ($form->isValid()) {

			$projet->exchangeArray($form->getData());
			$this->getProjetTable()->saveProjet($projet);
			// Redirect to list of projets
			$save=true;
		}
		}
		$view = new ViewModel(array(
            'form' => $form,
		    'save' => $save,
        ));
          $view->setTerminal(true);


        return $view;


    }

    public function editAction()
    {
        $this->sessionControle();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $id=$_POST['idprojet'];
        }else{
            $id = (int) $this->params()->fromRoute('id', 0);
        }
        $save=false;
		if (!$id) {
			return $this->redirect()->toRoute('projet/add');
		}
		$projet = $this->getProjetTable()->getProjet($id);
		$form = new ProjetForm();
		$form->bind($projet);
		$form->get('submit')->setAttribute('value','Enregistrer');

		if ($request->isPost()) {
			$form->setInputFilter($projet->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getProjetTable()->saveProjet($form->getData());
				// Redirect to list of projets
				$save=true;
			}
		}

		$view = new ViewModel(array(
					'idprojet' => $id,
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
		if (!$id) {
		return $this->redirect()->toRoute('projet');
		}
		$request = $this->getRequest();
		$this->getProjetTable()->deleteProjet($id);
		return $this->redirect()->toRoute('projet');

    }

    public function getProjetTable()
    {
        if (!$this->projetTable) {
            $sm = $this->getServiceLocator();
            $this->projetTable = $sm->get('Projet\Model\ProjetTable');
        }
        return $this->projetTable;
    }


}