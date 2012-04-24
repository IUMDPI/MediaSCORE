<?php

/**
 * digitalbetacam actions.
 *
 * @package    mediaSCORE
 * @subpackage digitalbetacam
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class digitalbetacamActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->digital_betacams = Doctrine_Core::getTable('DigitalBetacam')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->digital_betacam);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DigitalBetacamForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DigitalBetacamForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id'))), sprintf('Object digital_betacam does not exist (%s).', $request->getParameter('id')));
    $this->form = new DigitalBetacamForm($digital_betacam);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id'))), sprintf('Object digital_betacam does not exist (%s).', $request->getParameter('id')));
    $this->form = new DigitalBetacamForm($digital_betacam);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id'))), sprintf('Object digital_betacam does not exist (%s).', $request->getParameter('id')));
    $digital_betacam->delete();

    $this->redirect('digitalbetacam/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $digital_betacam = $form->save();

      $this->redirect('digitalbetacam/edit?id='.$digital_betacam->getId());
    }
  }
}
