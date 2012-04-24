<?php

/**
 * evaluatorhistory actions.
 *
 * @package    mediaSCORE
 * @subpackage evaluatorhistory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluatorhistoryActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
	$this->evaluator_historys = Doctrine_Core::getTable('AssetGroup')
					->find(array(
						$request->getParameter('id')))
					->getEvaluatorHistory();
	  
    /*$this->evaluator_historys = Doctrine_Core::getTable('EvaluatorHistory')
      ->createQuery('a')
      ->execute();*/
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->evaluator_history);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new EvaluatorHistoryForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EvaluatorHistoryForm();

    /*echo 'trace';
    echo var_dump($request);
    exit();*/

    $this->processForm($request, $this->form);

    $this->setTemplate('new');

    //$this->forward($this->getModuleName(),'new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
    $this->form = new EvaluatorHistoryForm($evaluator_history);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
    $this->form = new EvaluatorHistoryForm($evaluator_history);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
    $evaluator_history->delete();

    $this->redirect('evaluatorhistory/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

	    $evaluator_history = $form->save();
	    //echo $evaluator_history->getAssetGroupId();
	    //echo var_dump( $evaluator_history );
	    //exit();

      //$evaluator_history = $form->save();

      //$this->redirect('evaluatorhistory/edit?id='.$evaluator_history->getId());
      $this->redirect('evaluatorhistory/index?id='.$evaluator_history->getAssetGroupId());
    }
  }
}
