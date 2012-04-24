<?php

/**
 * pressedfortyfiverpmdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage pressedfortyfiverpmdisc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pressedfortyfiverpmdiscActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pressed_forty_five_rpm_discs = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pressed_forty_five_rpm_disc);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PressedFortyFiveRPMDiscForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PressedFortyFiveRPMDiscForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
    $this->form = new PressedFortyFiveRPMDiscForm($pressed_forty_five_rpm_disc);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
    $this->form = new PressedFortyFiveRPMDiscForm($pressed_forty_five_rpm_disc);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
    $pressed_forty_five_rpm_disc->delete();

    $this->redirect('pressedfortyfiverpmdisc/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pressed_forty_five_rpm_disc = $form->save();

      $this->redirect('pressedfortyfiverpmdisc/edit?id='.$pressed_forty_five_rpm_disc->getId());
    }
  }
}
