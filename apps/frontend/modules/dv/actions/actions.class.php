<?php

/**
 * dv actions.
 *
 * @package    mediaSCORE
 * @subpackage dv
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->d_vs = Doctrine_Core::getTable('DV')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->dv);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DVForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DVForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVForm($dv);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVForm($dv);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));
    $dv->delete();

    $this->redirect('dv/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dv = $form->save();

      $this->redirect('dv/edit?id='.$dv->getId());
    }
  }
}
