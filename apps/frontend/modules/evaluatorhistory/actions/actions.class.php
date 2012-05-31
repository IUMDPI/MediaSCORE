<?php

/**
 * evaluatorhistory actions.
 *
 * @package    mediaSCORE
 * @subpackage evaluatorhistory
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class evaluatorhistoryActions extends sfActions {

    public function executeGetConsultedPersons(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {

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
                    $this->evaluators[$evaluatorHistoryID] = Doctrine_Core::getTable('Evaluator')
                            ->find($evaluatorHistoryID);

                foreach (Doctrine_Core::getTable('EvaluatorHistoryPersonnel')->findBy('evaluator_history_id', $evaluatorHistory->getId()) as $consultationRecord) {
                    $this->consultedPersons[$evaluatorHistory->getId()][] = Doctrine_Core::getTable('Person')
                            ->findOneBy('id', $consultationRecord->getPersonId());
                }
            }
        }
    }

    /*  public function executeShow(sfWebRequest $request)
      {
      $this->evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id')));
      $this->forward404Unless($this->evaluator_history);
      } */

    public function executeNew(sfWebRequest $request) {

        $this->form = new EvaluatorHistoryForm(
                        null,
                        array('creatorID' => $this->getUser()->getGuardUser()->getId()
                        )
        );
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EvaluatorHistoryForm(null,
                        array('creatorID' => $this->getUser()->getGuardUser()->getId()
                ));

        /* echo 'trace';
          echo var_dump($request);
          exit(); */

        $this->processForm($request, $this->form);

        $this->setTemplate('new');

        //$this->forward($this->getModuleName(),'new');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));




        $this->form = new EvaluatorHistoryForm($evaluator_history, array('creatorID' => $this->getUser()->getGuardUser()->getId()
                ));
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
        $this->form = new EvaluatorHistoryForm($evaluator_history, array('creatorID' => $this->getUser()->getGuardUser()->getId()
                ));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($evaluator_history = Doctrine_Core::getTable('EvaluatorHistory')->find(array($request->getParameter('id'))), sprintf('Object evaluator_history does not exist (%s).', $request->getParameter('id')));
        $evaluator_history->delete();

        $this->redirect('evaluatorhistory/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            /*

              $formValues=$form->getValues();
              // Doctrine does not bind values properly, and I cannot remove field values which are null and for which there exists no NOT NULL MySQL table constraint
              if($form->getObject()->isNew()) {
              echo 'trace';
              $evaluatorHistory=Doctrine_Core::getTable('EvaluatorHistory')->create(array(
              'updated_at' => $formValues['updated_at'])); // The only field with a NOT NULL constraint.
              $evaluatorHistory->save();
              } else {
              $evaluatorHistory=$form->getObject();
              }

              if(isset($formValues['person_list']))
              foreach($formValues['person_list'] as $personID)
              Doctrine_Core::getTable('EvaluatorHistoryPersonnel')->create(array(
              'evaluator_history_id' => $evaluatorHistory->getId(),
              'person_id' => $personID))->save();

              unset($formValues['person_list']);

              // 0 is stored as NULL
              $evaluatorHistory->set('type',$formValues['type']);
              $evaluatorHistory->save();
              foreach(array_keys($formValues) as $formField) {
              if($formValues[$formField] && !$evaluatorHistory->get($formField)) {
              $evaluatorHistory->set($formField,$formValues[$formField]);
              $evaluatorHistory->save();
              }
              }

             */
            $evaluatorHistory = $form->save();


            //$evaluator_history = $form->save();
            $this->redirect('evaluatorhistory/edit?id=' . $evaluatorHistory->getId());
        }
    }

}
