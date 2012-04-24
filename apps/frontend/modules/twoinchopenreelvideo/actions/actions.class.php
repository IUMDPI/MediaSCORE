<?php

/**
 * twoinchopenreelvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage twoinchopenreelvideo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class twoinchopenreelvideoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->two_inch_open_reel_videos = Doctrine_Core::getTable('TwoInchOpenReelVideo')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->two_inch_open_reel_video);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TwoInchOpenReelVideoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TwoInchOpenReelVideoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new TwoInchOpenReelVideoForm($two_inch_open_reel_video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $this->form = new TwoInchOpenReelVideoForm($two_inch_open_reel_video);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($two_inch_open_reel_video = Doctrine_Core::getTable('TwoInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object two_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
    $two_inch_open_reel_video->delete();

    $this->redirect('twoinchopenreelvideo/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $two_inch_open_reel_video = $form->save();

      $this->redirect('twoinchopenreelvideo/edit?id='.$two_inch_open_reel_video->getId());
    }
  }
}
