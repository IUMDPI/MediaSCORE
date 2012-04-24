<?php

/**
 * pressedlpdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage pressedlpdisc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pressedlpdiscActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pressed_lp_discs = Doctrine_Core::getTable('PressedLPDisc')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pressed_lp_disc);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PressedLPDiscForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PressedLPDiscForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
    $this->form = new PressedLPDiscForm($pressed_lp_disc);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
    $this->form = new PressedLPDiscForm($pressed_lp_disc);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
    $pressed_lp_disc->delete();

    $this->redirect('pressedlpdisc/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pressed_lp_disc = $form->save();

      $this->redirect('pressedlpdisc/edit?id='.$pressed_lp_disc->getId());
    }
  }
}
