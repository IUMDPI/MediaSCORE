<?php

/**
 * oneinchopenreelvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage oneinchopenreelvideo
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class oneinchopenreelvideoActions extends sfActions
{

	/**
	 * List All OneInchOpenReelVideo
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->one_inch_open_reel_videos = Doctrine_Core::getTable('OneInchOpenReelVideo')
		->createQuery('a')
		->execute();
	}

	/**
	 * OneInchOpenReelVideo Detail of specific record
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeShow(sfWebRequest $request)
	{
		$this->one_inch_open_reel_video = Doctrine_Core::getTable('OneInchOpenReelVideo')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->one_inch_open_reel_video);
	}

	/**
	 * OneInchOpenReelVideo Form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeNew(sfWebRequest $request)
	{
		$this->form = new OneInchOpenReelVideoForm();
	}

	/**
	 * OneInchOpenReelVideo Post form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new OneInchOpenReelVideoForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	/**
	 * OneInchOpenReelVideo Edit form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($one_inch_open_reel_video = Doctrine_Core::getTable('OneInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object one_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
		$this->form = new OneInchOpenReelVideoForm($one_inch_open_reel_video);
		$reelSize = explode(',', $one_inch_open_reel_video->getReelSize());

		$this->form->setDefault('reelSize', $reelSize);
	}

	/**
	 * OneInchOpenReelVideo Post edit form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($one_inch_open_reel_video = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object one_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));

		$one_inch_open_reel_video->setType(34);
		$one_inch_open_reel_video->save();
		$one_inch_open_reel_video = Doctrine_Core::getTable('OneInchOpenReelVideo')->find(array($request->getParameter('id')));
		$this->form = new OneInchOpenReelVideoForm($one_inch_open_reel_video);


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
	 * OneInchOpenReelVideo Delete function
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($one_inch_open_reel_video = Doctrine_Core::getTable('OneInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object one_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
		$one_inch_open_reel_video->delete();

		$this->redirect('oneinchopenreelvideo/index');
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
			$one_inch_open_reel_video = $form->save();
			$saveReturnId = array('form' => true, 'id' => $one_inch_open_reel_video->getId());
			return $saveReturnId;
		}
		return false;
	}

}
