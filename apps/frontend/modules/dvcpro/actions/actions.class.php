<?php

/**
 * dvcpro actions.
 *
 * @package    mediaSCORE
 * @subpackage dvcpro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvcproActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->dvc_pros = Doctrine_Core::getTable('DVCPro')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->dvc_pro);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DVCProForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DVCProForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id'))), sprintf('Object dvc_pro does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVCProForm($dvc_pro);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id'))), sprintf('Object dvc_pro does not exist (%s).', $request->getParameter('id')));
    $this->form = new DVCProForm($dvc_pro);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id'))), sprintf('Object dvc_pro does not exist (%s).', $request->getParameter('id')));
    $dvc_pro->delete();

    $this->redirect('dvcpro/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dvc_pro = $form->save();

      $this->redirect('dvcpro/edit?id='.$dvc_pro->getId());
    }
  }
}
