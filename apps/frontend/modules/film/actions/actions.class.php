<?php

/**
 * film actions.
 *
 * @package    mediaSCORE
 * @subpackage film
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filmActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->films = Doctrine_Core::getTable('Film')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->film = Doctrine_Core::getTable('Film')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->film);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FilmForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FilmForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($film = Doctrine_Core::getTable('Film')->find(array($request->getParameter('id'))), sprintf('Object film does not exist (%s).', $request->getParameter('id')));
    $this->form = new FilmForm($film);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($film = Doctrine_Core::getTable('Film')->find(array($request->getParameter('id'))), sprintf('Object film does not exist (%s).', $request->getParameter('id')));
    $this->form = new FilmForm($film);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($film = Doctrine_Core::getTable('Film')->find(array($request->getParameter('id'))), sprintf('Object film does not exist (%s).', $request->getParameter('id')));
    $film->delete();

    $this->redirect('film/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $film = $form->save();

      $this->redirect('film/edit?id='.$film->getId());
    }
  }
}
