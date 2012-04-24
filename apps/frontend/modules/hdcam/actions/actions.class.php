<?php

/**
 * hdcam actions.
 *
 * @package    mediaSCORE
 * @subpackage hdcam
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hdcamActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->hd_cams = Doctrine_Core::getTable('HDCam')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->hd_cam);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HDCamForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new HDCamForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id'))), sprintf('Object hd_cam does not exist (%s).', $request->getParameter('id')));
    $this->form = new HDCamForm($hd_cam);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id'))), sprintf('Object hd_cam does not exist (%s).', $request->getParameter('id')));
    $this->form = new HDCamForm($hd_cam);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id'))), sprintf('Object hd_cam does not exist (%s).', $request->getParameter('id')));
    $hd_cam->delete();

    $this->redirect('hdcam/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $hd_cam = $form->save();

      $this->redirect('hdcam/edit?id='.$hd_cam->getId());
    }
  }
}
