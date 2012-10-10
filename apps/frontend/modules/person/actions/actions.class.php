<?php

/**
 * person actions.
 *
 * @package    mediaSCORE
 * @subpackage person
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personActions extends sfActions {

    /**
     * get list of persons for specific asset group
     * 
     * @param sfWebRequest $request
     * @return json 
     */
    public function executeGetPersonsForAssetGroup(sfWebRequest $request) {

        $unitId = $request->getParameter('u');
        $this->forward404Unless($request->isXmlHttpRequest() && $unitId);
        // Needs optimization
        $persons = Doctrine_Query::Create()
                ->from('Person p')
                ->select('p.id,p.first_name,p.last_name')
                ->innerJoin('p.UnitPerson up')
                ->where('up.unit_id =?', $unitId)
                ->fetchArray();

        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');
        $this->setTemplate('index');
        return $this->renderText(json_encode(array('list' => $persons, 'login_person' => $this->getUser()->getAttribute('personnel_list'))));
    }

    /**
     * List all
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->persons = Doctrine_Core::getTable('Person')
                ->createQuery('a')
                ->execute();
    }

    /**
     * detail of specific record
     * 
     * @param sfWebRequest $request
     * @return type 
     */
    public function executeShow(sfWebRequest $request) {
        $this->person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id')));

        if ($request->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->person->toArray()));
        } else
            $this->forward404Unless($this->person);
    }

    /**
     * Person form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new PersonForm();
    }

    /**
     * Person Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PersonForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Person edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
        $this->form = new PersonForm($person);
    }

    /**
     * Person Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
        $this->form = new PersonForm($person);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Person Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {


        $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
        $person->delete();

        $this->redirect('person/index');
    }

    /**
     * process and validate form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form 
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $person = $form->save();
            $person->setUsername($person->getEmailAddress());
            $person->save();
            $this->redirect('person/index');
        }
    }

}
