<?php

/**
 * halfinchopenreelvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage halfinchopenreelvideo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class halfinchopenreelvideoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->half_inch_open_reel_videos = Doctrine_Core::getTable('HalfInchOpenReelVideo')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->half_inch_open_reel_video);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HalfInchOpenReelVideoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new HalfInchOpenReelVideoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object half_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new HalfInchOpenReelVideoForm($half_inch_open_reel_video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object half_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new HalfInchOpenReelVideoForm($half_inch_open_reel_video);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object half_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $half_inch_open_reel_video->delete();

    $this->redirect('halfinchopenreelvideo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $half_inch_open_reel_video = $form->save();

      $this->redirect('halfinchopenreelvideo/edit?id='.$half_inch_open_reel_video->getId());
    }
  }
}
