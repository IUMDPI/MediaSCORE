<?php

/**
 * cylinder actions.
 *
 * @package    mediaSCORE
 * @subpackage cylinder
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cylinderActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cylinders = Doctrine_Core::getTable('Cylinder')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->cylinder = Doctrine_Core::getTable('Cylinder')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->cylinder);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CylinderForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CylinderForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cylinder = Doctrine_Core::getTable('Cylinder')->find(array($request->getParameter('id'))), sprintf('Object cylinder does not exist (%s).', $request->getParameter('id')));
    $this->form = new CylinderForm($cylinder);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cylinder = Doctrine_Core::getTable('Cylinder')->find(array($request->getParameter('id'))), sprintf('Object cylinder does not exist (%s).', $request->getParameter('id')));
    $this->form = new CylinderForm($cylinder);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cylinder = Doctrine_Core::getTable('Cylinder')->find(array($request->getParameter('id'))), sprintf('Object cylinder does not exist (%s).', $request->getParameter('id')));
    $cylinder->delete();

    $this->redirect('cylinder/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cylinder = $form->save();

      $this->redirect('cylinder/edit?id='.$cylinder->getId());
    }
  }
}
