<?php

/**
 * dvcam actions.
 *
 * @package    mediaSCORE
 * @subpackage dvcam
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvcamActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->dv_cams = Doctrine_Core::getTable('DVCam')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->dv_cam);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DVCamForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DVCamForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVCamForm($dv_cam);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVCamForm($dv_cam);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
    $dv_cam->delete();

    $this->redirect('dvcam/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dv_cam = $form->save();

      $this->redirect('dvcam/edit?id='.$dv_cam->getId());
    }
  }
}
