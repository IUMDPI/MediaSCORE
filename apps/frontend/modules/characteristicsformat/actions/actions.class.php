<?php

/**
 * characteristicsformat actions.
 *
 * @package    mediaSCORE
 * @subpackage characteristicsformat
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class characteristicsformatActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->characteristics_formats = Doctrine_Core::getTable('CharacteristicsFormat')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CharacteristicsFormatForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CharacteristicsFormatForm();
 
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($characteristics_format = Doctrine_Core::getTable('CharacteristicsFormat')->find(array($request->getParameter('id'))), sprintf('Object characteristics_format does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharacteristicsFormatForm($characteristics_format);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($characteristics_format = Doctrine_Core::getTable('CharacteristicsFormat')->find(array($request->getParameter('id'))), sprintf('Object characteristics_format does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharacteristicsFormatForm($characteristics_format);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($characteristics_format = Doctrine_Core::getTable('CharacteristicsFormat')->find(array($request->getParameter('id'))), sprintf('Object characteristics_format does not exist (%s).', $request->getParameter('id')));
    $characteristics_format->delete();

    $this->redirect('characteristicsformat/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $characteristics_format = $form->save();
      $this->redirect('characteristicsformat/new');
//      $this->redirect('characteristicsformat/edit?id='.$characteristics_format->getId());
    }
  }
}
