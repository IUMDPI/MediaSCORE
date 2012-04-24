<?php

/**
 * betamax actions.
 *
 * @package    mediaSCORE
 * @subpackage betamax
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class betamaxActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->betamaxs = Doctrine_Core::getTable('Betamax')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->betamax);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BetamaxForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BetamaxForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id'))), sprintf('Object betamax does not exist (%s).', $request->getParameter('id')));
    $this->form = new BetamaxForm($betamax);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id'))), sprintf('Object betamax does not exist (%s).', $request->getParameter('id')));
    $this->form = new BetamaxForm($betamax);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id'))), sprintf('Object betamax does not exist (%s).', $request->getParameter('id')));
    $betamax->delete();

    $this->redirect('betamax/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $betamax = $form->save();

      $this->redirect('betamax/edit?id='.$betamax->getId());
    }
  }
}
