<?php

/**
 * optical actions.
 *
 * @package    mediaSCORE
 * @subpackage optical
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class opticalActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->optical_videos = Doctrine_Core::getTable('OpticalVideo')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->optical_video);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OpticalVideoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OpticalVideoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpticalVideoForm($optical_video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpticalVideoForm($optical_video);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
    $optical_video->delete();

    $this->redirect('optical/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $optical_video = $form->save();

      $this->redirect('optical/edit?id='.$optical_video->getId());
    }
  }
}
