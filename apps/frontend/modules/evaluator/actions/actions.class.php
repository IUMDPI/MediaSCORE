<?php

/**
 * evaluator actions.
 *
 * @package    mediaSCORE
 * @subpackage evaluator
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluatorActions extends sfActions {

    /**
     * List Evaluator
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->evaluators = Doctrine_Core::getTable('Evaluator')
                ->createQuery('a')
                ->execute();
    }
    /**
     * Show Specific Evalutor
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->evaluator);
    }
    /**
     * Generate Evaluator form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new EvaluatorForm();
    }
    /**
     * Evaluator Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EvaluatorForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }
    /**
     * Evaluator Edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
        $this->form = new EvaluatorForm($evaluator);
    }
    /**
     * Evaluator Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
        $this->form = new EvaluatorForm($evaluator);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }
    /**
     * Delete Evaluator
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($evaluator = Doctrine_Core::getTable('Evaluator')->find(array($request->getParameter('id'))), sprintf('Object evaluator does not exist (%s).', $request->getParameter('id')));
        $evaluator->delete();

        $this->redirect('evaluator/index');
    }
    /**
     * Process and validate form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form 
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $evaluator = $form->save();

            $this->redirect('evaluator/edit?id=' . $evaluator->getId());
        }
    }

}
