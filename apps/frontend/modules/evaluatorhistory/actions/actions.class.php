<?php

/**
 * evaluatorhistory actions.
 *
 * @package    mediaSCORE
 * @subpackage evaluatorhistory
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluatorhistoryActions extends sfActions {

    /**
     * Get Consulted persons
     * 
     * @param sfWebRequest $request
     * @return json 
     */
    public function executeGetConsultedPersons(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
            // get the histroy of Evaluator
            $consultationRecords = Doctrine_Core::getTable('EvaluatorHistoryPersonnel')
                    ->findBy('evaluator_history_id', $request->getParameter('id'));

            $persons = array();
            foreach ($consultationRecords as $consultationRecord) {
                $persons[] = Doctrine_Core::getTable('Person')
                                ->find($consultationRecord->getPersonId())->toArray();
            }

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            $this->setTemplate('index');
            return $this->renderText(json_encode($persons));
        }
    }

    /**
     * List EvaluatorHistoryPersonnel
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {

        $agID = $request->getParameter('id');
        $this->evaluator_historys = array();

        if ($agID) {
            $ag = Doctrine_Core::getTable('AssetGroup')
                    ->find(array(
                $request->getParameter('id')));

            $this->evaluator_historys = $ag->getEvaluatorHistory();

            $this->evaluators = array();
            $this->consultedPersons = array();
            foreach ($this->evaluator_historys as $evaluatorHistory) {
                $evaluatorHistoryID = $evaluatorHistory->getEvaluatorId();
                if ($evaluatorHistoryID)
                    $this->evaluators[$evaluatorHistoryID] = Doctrine_Core::getTable('sfGuardUser')
                            ->findOneBy('id', $evaluatorHistoryID);

                foreach (Doctrine_Core::getTable('EvaluatorHistoryPersonnel')->findBy('evaluator_history_id', $evaluatorHistory->getId()) as $consultationRecord) {
                    $this->consultedPersons[$evaluatorHistory->getId()][] = Doctrine_Core::getTable('Person')
                            ->findOneBy('id', $consultationRecord->getPersonId());
                }
            }
        }
    }

    /**
     * Generate EvaluatorHistoryPersonnel form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {

        $this->form = new EvaluatorHistoryForm(
                        null,
                        array('creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'action' => 'new'
                        )
        );
    }

    /**
     * EvaluatorHistoryPersonnel Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EvaluatorHistoryForm(null,
                        array('creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'action' => 'new'
                ));

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * EvaluatorHistoryPersonnel edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
        $this->form = new EvaluatorHistoryForm($evaluator_history, array('creatorID' => $this->getUser()->getGuardUser()->getId()
                ));
    }

    /**
     * EvaluatorHistoryPersonnel Post edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
        $this->form = new EvaluatorHistoryForm($evaluator_history, array('creatorID' => $this->getUser()->getGuardUser()->getId()
                ));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Delete EvaluatorHistoryPersonnel
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
        $evaluator_history->delete();

        $this->redirect('evaluatorhistory/index');
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
            $evaluatorHistory = $form->save();
        }
    }

}
