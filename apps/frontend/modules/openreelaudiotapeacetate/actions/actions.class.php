<?php

/**
 * openreelaudiotapeacetate actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapeacetate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapeacetateActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->open_reel_audiotape_acetates = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->open_reel_audiotape_acetate);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OpenReelAudiotapeAcetateForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OpenReelAudiotapeAcetateForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpenReelAudiotapeAcetateForm($open_reel_audiotape_acetate);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));
    $this->form = new OpenReelAudiotapeAcetateForm($open_reel_audiotape_acetate);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));
    $open_reel_audiotape_acetate->delete();

    $this->redirect('openreelaudiotapeacetate/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $open_reel_audiotape_acetate = $form->save();

      $this->redirect('openreelaudiotapeacetate/edit?id='.$open_reel_audiotape_acetate->getId());
    }
  }
}
