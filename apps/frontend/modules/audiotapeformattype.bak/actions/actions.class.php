<?php

/**
 * audiotapeformattype actions.
 *
 * @package    mediaSCORE
 * @subpackage audiotapeformattype
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class audiotapeformattypeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->audiotape_format_types = Doctrine_Core::getTable('AudiotapeFormatType')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
	  echo var_dump(Doctrine_Core::getTable('AudiotapeFormatType'));
    $this->audiotape_format_type = Doctrine_Core::getTable('AudiotapeFormatType')->find(array($request->getParameter('id')));
    //$this->forward404Unless($this->audiotape_format_type);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AudiotapeFormatTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AudiotapeFormatTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($audiotape_format_type = Doctrine_Core::getTable('AudiotapeFormatType')->find(array($request->getParameter('id'))), sprintf('Object audiotape_format_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new AudiotapeFormatTypeForm($audiotape_format_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($audiotape_format_type = Doctrine_Core::getTable('AudiotapeFormatType')->find(array($request->getParameter('id'))), sprintf('Object audiotape_format_type does not exist (%s).', $request->getParameter('id')));
    $this->form = new AudiotapeFormatTypeForm($audiotape_format_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($audiotape_format_type = Doctrine_Core::getTable('AudiotapeFormatType')->find(array($request->getParameter('id'))), sprintf('Object audiotape_format_type does not exist (%s).', $request->getParameter('id')));
    $audiotape_format_type->delete();

    $this->redirect('audiotapeformattype/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $audiotape_format_type = $form->save();

      $this->redirect('audiotapeformattype/edit?id='.$audiotape_format_type->getId());
    }
  }
}
