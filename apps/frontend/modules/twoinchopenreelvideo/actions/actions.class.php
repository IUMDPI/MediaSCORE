<?php

/**
 * twoinchopenreelvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage twoinchopenreelvideo
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class twoinchopenreelvideoActions extends sfActions
{

	/**
	 * List all TwoInchOpenReelVideo
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->two_inch_open_reel_videos = Doctrine_Core::getTable('TwoInchOpenReelVideo')
		->createQuery('a')
		->execute();
	}

	/**
	 * TwoInchOpenReelVideo detail of specific record
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeShow(sfWebRequest $request)
	{
		$this->two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->two_inch_open_reel_video);
	}

	/**
	 * TwoInchOpenReelVideo form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new TwoInchOpenReelVideoForm();
	}

	/**
	 * TwoInchOpenReelVideo Post form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new TwoInchOpenReelVideoForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
	 * TwoInchOpenReelVideo edit form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
		$this->form = new TwoInchOpenReelVideoForm($two_inch_open_reel_video);
		$reelSize = explode(',', $two_inch_open_reel_video->getReelSize());

		$this->form->setDefault('reelSize', $reelSize);
	}

	/**
	 * TwoInchOpenReelVideo Post edit form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));

		$two_inch_open_reel_video->setType(33);
		$two_inch_open_reel_video->save();
		$two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id')));
		$this->form = new TwoInchOpenReelVideoForm($two_inch_open_reel_video);


		$validateForm = $this->processForm($request, $this->form);

		if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true)
		{
			echo $validateForm['id'];
			exit;
		}
		else
		{
			$this->setTemplate('edit');
		}
	}

	/**
	 * TwoInchOpenReelVideo Delete form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
		$two_inch_open_reel_video->delete();

		$this->redirect('twoinchopenreelvideo/index');
	}

	/**
	 * Process and validate form
	 * 
	 * @param sfWebRequest $request
	 * @param sfForm $form
	 * @return boolean if form is not validated
	 * @return integer if form is validated then return id
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$two_inch_open_reel_video = $form->save();
			$saveReturnId = array('form' => true, 'id' => $two_inch_open_reel_video->getId());
			return $saveReturnId;
		}
		return false;
	}

}
