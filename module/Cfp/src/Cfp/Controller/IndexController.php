<?php

namespace Cfp\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Cfp\Form\SubmissionForm;
use Admin\Model\TrackTable;
use Cfp\Model\Submission;
use Cfp\Model\SubmissionUser;

class IndexController extends AbstractActionController
{
	protected $conferenceTable;
	protected $trackTable;
	protected $submissionTable;
	protected $submissionUserTable;
		
    public function indexAction()
    {
		return array(
			'conferences' => $this->getConferenceTable()->fetchFullData(),
		);
    }
	
	public function submitAction()
	{
		if (!$conference_id = $this->params()->fromRoute('id', 0)) {
			return $this->redirect()->toRoute('cfp');
		}
		
		$tracks_form = array();
		$tracks = $this->getTrackTable()->getTracksByConference((int) $conference_id);

		foreach ($tracks as $t)
			$tracks_form[$t->track_id] = $t->name;

		$form = new SubmissionForm(null, $tracks_form);
		
		// Paper submission
		$request = $this->getRequest();

		if ($request->isPost()) {
			$submission = new Submission();
			$form->setInputFilter($submission->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$formData = $form->getData();
				$formData['conference_id'] = $conference_id;	

				$submission->exchangeArray($formData);
				$submission_id = $this->getSubmissionTable()->saveSubmission($submission);	

				$submissionUser = new SubmissionUser();
				$submissionUser->exchangeArray(array(
					'submission_id'	=> $submission_id,
					'user_id'		=> $this->zfcUserAuthentication()->getIdentity()->getId(),
					'status'		=> 'confirmed',
					'main'			=> 1,
				));
				
				$this->getSubmissionUserTable()->saveSubmissionUser($submissionUser);
				
				return $this->redirect()->toRoute('cfp/ok');
			}
		}

		return array(
			'form' => $form,
			'conference_id' => $conference_id,
		);
	}
	
	public function okAction()
	{
		return array();
	}
	
	protected function getConferenceTable()
	{
		if (!$this->conferenceTable)
			$this->conferenceTable = $this->getServiceLocator()->get('Admin\Model\ConferenceTable');
		return $this->conferenceTable;
	}
	
	protected function getTrackTable()
	{
		if (!$this->trackTable)
			$this->trackTable = $this->getServiceLocator()->get('Admin\Model\TrackTable');
		return $this->trackTable;
	}
	
	protected function getSubmissionTable()
	{
		if (!$this->submissionTable)
			$this->submissionTable = $this->getServiceLocator()->get('Cfp\Model\SubmissionTable');
		return $this->submissionTable;
	}
	
	protected function getSubmissionUserTable()
	{
		if (!$this->submissionUserTable)
			$this->submissionUserTable = $this->getServiceLocator()->get('Cfp\Model\SubmissionUserTable');
		return $this->submissionUserTable;
	}
}
