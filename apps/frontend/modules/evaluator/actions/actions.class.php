<?php

/**
 * evaluator actions.
 *
 * @package    mediaSCORE
 * @subpackage evaluator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluatorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->evaluators = Doctrine_Core::getTable('Evaluator')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->evaluator);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EvaluatorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EvaluatorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
    $this->form = new EvaluatorForm($evaluator);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
    $this->form = new EvaluatorForm($evaluator);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
    $evaluator->delete();

    $this->redirect('evaluator/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $evaluator = $form->save();

      $this->redirect('evaluator/edit?id='.$evaluator->getId());
    }
  }
}
