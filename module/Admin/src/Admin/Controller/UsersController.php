<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Form\UserForm;

use Admin\Model\User;
use Admin\Model\UserTable;

class UsersController extends AbstractActionController
{
	
	protected $userTable;
	//protected $submissionTable;
	//protected $conferenceAttendeeTable;
	
	public function indexAction()
	{
		return array(
			'users' => $this->getUsersTable()->fetchAll(),
		);
	}

	/* public function addAction()
	{
		$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
		$form = new ConferenceForm(null, $user_id);
		
		$request = $this->getRequest();

		if ($request->isPost()) {
			$conference = new Conference();
			$form->setInputFilter($conference->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$conference->exchangeArray($form->getData());
				$this->getConferencesTable()->saveConference($conference);

				// Redirect to list
				return $this->redirect()->toRoute('admin/conferences');
			}
		}
		
		return(array('form' => $form));
	} 

	public function editAction()
	{

		$id = (int) $this->params()->fromRoute('id');

		$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
		$form = new UserForm(null, $user_id, array('name' => 'Naame', 'description' => 'DESC', 'gmt' => '3.0'));

		$request = $this->getRequest();

		if ($request->isPost()) {
			$user = new User();
			$form->setInputFilter($user->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$user->exchangeArray($form->getData());
				$this->getConferencesTable()->saveConference($user);

				// Redirect to list
				return $this->redirect()->toRoute('admin/users');
			}
		}
		
		return(array('form' => $form));
	} */

	protected function getUsersTable()
	{
		if (!$this->userTable)
		{
			$sm = $this->getServiceLocator();
			$this->userTable = $sm->get('Admin\Model\UserTable');
		}
		return $this->userTable;
	}
	
}