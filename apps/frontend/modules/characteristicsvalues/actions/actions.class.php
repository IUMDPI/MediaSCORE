<?php

/**
 * characteristicsvalues actions.
 *
 * @package    mediaSCORE
 * @subpackage characteristicsvalues
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class characteristicsvaluesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->characteristics_valuess = Doctrine_Core::getTable('CharacteristicsValues')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CharacteristicsValuesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CharacteristicsValuesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($characteristics_values = Doctrine_Core::getTable('CharacteristicsValues')->find(array($request->getParameter('id'))), sprintf('Object characteristics_values does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharacteristicsValuesForm($characteristics_values);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($characteristics_values = Doctrine_Core::getTable('CharacteristicsValues')->find(array($request->getParameter('id'))), sprintf('Object characteristics_values does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharacteristicsValuesForm($characteristics_values);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($characteristics_values = Doctrine_Core::getTable('CharacteristicsValues')->find(array($request->getParameter('id'))), sprintf('Object characteristics_values does not exist (%s).', $request->getParameter('id')));
    $characteristics_values->delete();

    $this->redirect('characteristicsvalues/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $characteristics_values = $form->save();

      $this->redirect('characteristicsvalues/new');
//      $this->redirect('characteristicsvalues/edit?id='.$characteristics_values->getId());
    }
  }
}
