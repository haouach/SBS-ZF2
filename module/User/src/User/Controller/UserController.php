<?php

namespace User\Controller;

use Zend\Crypt\Password\Bcrypt;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,
    User\Model\User,
    User\Form\UserForm,
    Zend\Mail;


class UserController extends AbstractActionController
{
	protected $userTable;

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
            'users' => $this->getUserTable()->fetchAll()      ));
    }

    public function addAction()
    {
        $this->sessionControle();
        $form = new UserForm();
		$form->get('submit')->setValue('Ajouter');
		$request = $this->getRequest();
		if ($request->isPost()) {
		$user = new User();
		$form->setInputFilter($user->getInputFilter());
		$form->setData($request->getPost());
		if ($form->isValid()) {

			$user->exchangeArray($form->getData());
			$mdp=$user->generatePassword();
			$bcript= new Bcrypt();
			$bcript->setCost(14);
			$mdp=$bcript->create($mdp);
			$user->password=$mdp;
			$user->etat=1;

			$this->getUserTable()->saveUser($user);
			$message='Mot de passe : '.$mdp;
			// Configurer SMTP du serveur et activer l'envoi
			//$this->sendEmail($user->nom, $user->prenom, $user->email, $message);
			// Redirect to list of users
			return $this->redirect()->toRoute('user');
		}
		}
		return array('form' => $form,'menu' => 'user');

    }

    public function editAction()
    {
        $this->sessionControle();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id=$_POST['iduser'];
        }else{
            $id = (int) $this->params()->fromRoute('id', 0);
        }

		if (!$id) {
			return $this->redirect()->toRoute('user/add');
		}
		$user = $this->getUserTable()->getUser($id);
		$form = new UserForm();
		$form->bind($user);
		$form->get('submit')->setAttribute('value','Enregistrer');

		if ($request->isPost()) {
			$form->setInputFilter($user->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getUserTable()->saveUser($form->getData());
				// Redirect to list of users
				return $this->redirect()->toRoute('user');
			}
		}
		return array(
					'iduser' => $id,
					'form' => $form
		);
    }

    public function deleteAction()
    {
        $this->sessionControle();
        $id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
		return $this->redirect()->toRoute('user');
		}
		$request = $this->getRequest();
		$this->getUserTable()->deleteUser($id);
		return $this->redirect()->toRoute('user');

    }
    // module/User/src/User/Controller/userController.php:
    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }

    public function sendEmail($nom,$prenom,$email,$message)
    {
        $mail = new Mail\Message();
        $mail->setBody($message);
        $mail->setFrom('marouen.mneri@apd.com', 'SBS Test');
        $mail->addTo($email, $nom.' '.$prenom);
        $mail->setSubject('Acces utilisateur');

        $transport = new Mail\Transport\Sendmail();
        $transport->send($mail);

    }
}